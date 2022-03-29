<?php

namespace frontend\resource;

use yii\widgets\ListView;

class ShuffledListView extends ListView
{
    public function renderItems()
    {
        $models = $this->dataProvider->getModels();
        shuffle($models);
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach (array_values($models) as $index => $model) {
            $key = $keys[$index];
            if (($before = $this->renderBeforeItem($model, $key, $index)) !== null) {
                $rows[] = $before;
            }

            $rows[] = $this->renderItem($model, $key, $index);

            if (($after = $this->renderAfterItem($model, $key, $index)) !== null) {
                $rows[] = $after;
            }
        }

        return implode($this->separator, $rows);
    }
}