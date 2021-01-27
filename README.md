# yii2-freeze-column

Для базового использования нужно

Где-нибудь в коде GridView виджета, во время запуска, добавить код:

if ($this->freezed && $this->freezeOptions) {
            $freezeOptions = Json::htmlEncode(array_merge($this->freezeOptions, ['container' => "#{$id}-container"]));
            FreezeAsset::register($view);
            $view->registerJs("jQuery('#$id-container').freezeGridView('init', $freezeOptions);");
        }

Например в виджете GridView унаследованном от kartik, который вы используете в своем проекте.

В этот виджет нужно так же добавить нужные свойства

    /**
     * Включение закрепления колонок
     * @var bool
     */
    public $freezed = true;

    /**
     * Параметры закрепления (перечислить колонки, которые надо закрепить)
     * @var array
     *
     * ```php
     * $this->freezeOptions = [
     *   'freezeLeftColumns' => ['id', 'name', ...]
     *   'freezeRightColumns' => ['id', 'name', ...]
     * ]
     * ```
     */
    public $freezeOptions = [];

Работать же с колонками и формировать их массив мы будем в SearchModel, а именно в базовой модели, так чтобы методы были доступны везде или в тресте, так удобнее.
Значит добавляем туда нужные методы:

    /**
     * Возвращает настройки для закрепления
     * @return array
     */
    public function getFreezeOptions()
    {
        return [
            'freezeLeftColumns' => $this->getFreezeLeftColumns(),
            'freezeRightColumns' => $this->getFreezeRightColumns()
        ];
    }

Методы getFreezeLeftColumns и getFreezeRightColumns не привожу в документации, так как нет смысла, они у каждого свои. Но суть такая - эти методы должны возвращать названия колонок, которые нужно закрепить. Как и где их сохранять это уже решать каждому по своему. У меня сделано в базе данных, кто-то может в куках или сессии. 

Использовать вы это сможете так:

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $searchModel->getGridColumns(),
        'freezeOptions' => $searchModel->getFreezeOptions(),
    ])?>



