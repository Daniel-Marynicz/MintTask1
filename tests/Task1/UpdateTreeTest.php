<?php

declare(strict_types=1);

namespace Test\Task1;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Task1\FileGetContentsWrapper;
use Task1\UpdateTree;

class UpdateTreeTest extends TestCase
{
    private UpdateTree $updateTree;
    private MockObject $fileGetContentsWrapper;

    protected function setUp() : void
    {
        $this->fileGetContentsWrapper = $this->createMock(FileGetContentsWrapper::class);
        $this->updateTree             = new UpdateTree(new JsonEncoder(), $this->fileGetContentsWrapper);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetUpdatedTree(string $tree, string $list, string $language, string $expectedJson) : void
    {
        $this->fileGetContentsWrapper
            ->method('fileGetContents')
            ->withConsecutive(
                ['tree.json'],
                ['list.json']
            )
            ->willReturnOnConsecutiveCalls($tree, $list);

        $actualJson = $this->updateTree->getUpdatedTree('tree.json', 'list.json', $language);
        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetUpdatedTreeFromString(
        string $tree,
        string $list,
        string $language,
        string $expectedJson
    ) : void {
        $actualJson = $this->updateTree->getUpdatedTreeFromString($tree, $list, $language);
        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson);
    }

    /**
     * @return array|string[][]
     */
    public function dataProvider() : array
    {
        // phpcs:disable
        return [
            'test1' => [
                '[{"id":19,"children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[]}]}]}]}]',
                '[{"category_id":"30","order":"2","root":"1","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"1","category_id":"1","name":"some-name","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":1,"attribute_groups":[1,2]}}}]',
                'pl_PL',
                '[{"id":19,"children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[],"name":"some-name"}]}]}]}]',
            ],
            'test2' => [
                '[{"id":19,"children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[]}]}]}]}]',
                '[{"category_id":"30","order":"2","root":"1","in_loyalty":"0","translations":{"en_US":{"trans_id":"1","category_id":"1","name":"some-name","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":1,"attribute_groups":[1,2]}}}]',
                'en_US',
                '[{"id":19,"children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[],"name":"some-name"}]}]}]}]',
            ],
            'test3' => [
                '[{"id":19,"children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[{"id":31,"children":[{"id":32,"children":[{"id":33,"children":[{"id":34}]}]}]}]}]}]}]}]',
                '[{"category_id":"1","order":"2","root":"1","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"1","category_id":"1","name":"Kobiety","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":1,"attribute_groups":[1,2]}}},{"category_id":"2","order":"4","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"2","category_id":"2","name":"Spódnice","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":1,"attribute_groups":[2]}}},{"category_id":"3","order":"3","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"3","category_id":"3","name":"Spodnie","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[2]}}},{"category_id":"11","order":"5","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"11","category_id":"11","name":"Buty","description":"","active":"1","pres_id":null,"isdefault":"1","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[1]}}},{"category_id":"13","order":"6","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"13","category_id":"13","name":"Dodatki","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}},{"category_id":"14","order":"1","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"14","category_id":"14","name":"Bielizna","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":37,"attribute_groups":[]},"en_US":{"trans_id":"17","category_id":"14","name":"Majty","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"2","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}},{"category_id":"19","order":"0","root":"1","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"20","category_id":"19","name":"Zdrowie i uroda","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}},{"category_id":"20","order":"0","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"21","category_id":"20","name":"Perfumy","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}},{"category_id":"21","order":"0","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"22","category_id":"21","name":"Pielęgnacja ciała","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}},{"category_id":"34","order":"0","root":"0","in_loyalty":"0","translations":{"pl_PL":{"trans_id":"23","category_id":"22","name":"Pielęgnacja twarzy","description":"","active":"1","pres_id":null,"isdefault":"0","lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":0,"attribute_groups":[]}}}]',
                'pl_PL',
                '[{"id":19,"name":"Zdrowie i uroda","children":[{"id":22,"children":[{"id":26,"children":[{"id":30,"children":[{"id":31,"children":[{"id":32,"children":[{"id":33,"children":[{"id":34,"name":"Pielęgnacja twarzy"}]}]}]}]}]}]}]}]',
            ],
        ];
        // phpcs:enable
    }
}
