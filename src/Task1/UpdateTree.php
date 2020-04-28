<?php

declare(strict_types=1);

namespace Task1;

use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use UnexpectedValueException;
use function array_key_exists;
use function assert;
use function is_string;
use const JSON_PRETTY_PRINT;

class UpdateTree
{
    private JsonEncoder $jsonEncoder;
    private FileGetContentsWrapper $fileGetContents;

    public function __construct(JsonEncoder $jsonEncoder, FileGetContentsWrapper $fileGetContents)
    {
        $this->jsonEncoder     = $jsonEncoder;
        $this->fileGetContents = $fileGetContents;
    }

    public function getUpdatedTree(string $treePath, string $listPath, string $language) : string
    {
        $treeData = $this->fileGetContents->fileGetContents($treePath);
        $listData = $this->fileGetContents->fileGetContents($listPath);

        if (! is_string($treeData)) {
            throw new UnexpectedValueException('expected string in treeData');
        }

        if (! is_string($listData)) {
            throw new UnexpectedValueException('expected string in listData');
        }

        return $this->getUpdatedTreeFromString($treeData, $listData, $language);
    }

    public function getUpdatedTreeFromString(string $treeData, string $listData, string $language) : string
    {
        $list         = $this->jsonEncoder->decode($listData, 'json');
        $tree         = $this->jsonEncoder->decode($treeData, 'json');
        $translations = $this->getTranslationFromList($list, $language);

        foreach ($tree as &$treeItem) {
            $this->updateNamesInTreeItem($treeItem, $translations);
        }

        $encodeContext = [JsonEncode::OPTIONS => JSON_PRETTY_PRINT];

        $result = $this->jsonEncoder->encode($tree, 'json', $encodeContext);
        assert(is_string($result));

        return $result;
    }

    /**
     * @param mixed[] $treeItem
     * @param mixed[] $translations
     */
    private function updateNamesInTreeItem(array &$treeItem, array $translations) : void
    {
        $categoryId = (int) $treeItem['id'];
        $name       = $translations[$categoryId] ?? null;
        if ($name) {
            $treeItem['name'] = $name;
        }

        if (! isset($treeItem['children'])) {
            return;
        }

        foreach ($treeItem['children'] as &$treeItem) {
            $this->updateNamesInTreeItem($treeItem, $translations);
        }
    }

    /**
     * @param array|mixed[] $list
     *
     * @return mixed[]
     */
    private function getTranslationFromList(array $list, string $language) : array
    {
        $translations = [];
        foreach ($list as $listItem) {
            if (! array_key_exists('translations', $listItem)) {
                continue;
            }

            if (! array_key_exists($language, $listItem['translations'])) {
                continue;
            }

            $name                                         = $listItem['translations'][$language]['name'];
            $translations[(int) $listItem['category_id']] = $name;
        }

        return $translations;
    }
}
