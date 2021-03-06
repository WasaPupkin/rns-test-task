<?php
namespace app\commands;

use app\models\City;
use app\models\Qualification;
use app\models\User;
use yii\console\Controller;
use yii\db\Expression;

/**
 * Генерирует и записывает в БД некий набор данных.
 *
 */
class CreateDataController extends Controller{

    protected $peoples = [
        'name' => [
            'm' => ["Александр","Алексей","Анатолий","Андрей","Антон","Аркадий","Артём","Богдан","Борис","Вадим","Валентин","Валерий","Василий","Виктор","Виталий","Владимир","Владислав","Вячеслав","Гавриил","Геннадий","Георгий","Глеб","Григорий","Даниил","Данила","Денис","Дмитрий","Евгений","Егор","Кирилл","Иван","Игорь","Илья","Иннокентий","Лев","Леонид","Максим","Матвей","Михаил","Никита","Николай","Олег","Павел","Пётр","Роман","Ростислав","Руслан","Семён","Святослав","Сергей","Станислав","Степан","Тимофей","Тимур","Фёдор","Филипп","Эдуард","Юрий","Яков","Ярослав"],
            'f' => ["Агния","Алевтина","Александра","Алёна","Алина","Алиса","Алла","Анастасия","Ангелина","Анжела","Анна","Антонина","Анфиса","Арина","Валентина","Валерия","Варвара","Вера","Вероника","Виктория","Галина","Дарья","Диана","Евгения","Екатерина","Елена","Елизавета","Жанна","Зинаида","Зоя","Инна","Ирина","Клавдия","Кристина","Лариса","Лидия","Лилия","Любовь","Людмила","Маргарита","Марина","Мария","Марья","Виктория","Надежда","Наталья","Наталия","Нина","Оксана","Ольга","Полина","Раиса","Римма","Светлана","Анна","Снежана","София","Софья","Таисия","Тамара","Татьяна","Фаина","Элеонора","Элла","Эмма","Юлия","Яна","Александра","Алёна","Алина","Мария","Татьяна","Татьяна","Виктория","Евгения","Екатерина","Елена","Елизавета","Евгения","Анна","Екатерина","Елена","Елизавета","Любовь","Людмила","Маргарита","Марина","Любовь","Людмила","Маргарита","Марина","Валентина","Валерия","Надежда","Наталья","Инна","Ирина","Юлия","Юлия","Ольга","Полина","Ольга","Вера","Лариса","Лариса","Анна","Светлана","Анна"],
        ],
        'patro' => [
            'm' => ["Александрович","Алексеевич","Анатольевич","Андреевич","Антонович","Аркадьевич","Артёмович","Богданович","Борисович","Вадимович","Валентинович","Валерьевич","Васильевич","Викторович","Витальевич","Владимирович","Владиславович","Вячеславович","Гавриилович","Геннадьевич","Георгиевич","Глебович","Григорьевич","Даниилович","Данилович","Денисович","Дмитриевич","Евгеньевич","Егорович","Кириллович","Иванович","Игоревич","Ильич","Иннокентьевич","Львович","Леонидович","Максимович","Матвеевич","Михайлович","Никитич","Николаевич","Олегович","Павлович","Петрович","Романович","Ростиславович","Русланович","Семёнович","Святославович","Сергеевич","Станиславович","Степанович","Тимофеевич","Тимурович","Фёдорович","Филиппович","Эдуардович","Юрьевич","Яковлевич","Ярославович"],
            'f' => ["Александровна","Алексеевна","Анатольевна","Андреевна","Антоновна","Аркадиевна","Артёмовна","Богдановна","Борисовна","Вадимовна","Валентиновна","Валериевна","Васильевна","Викторовна","Витальевна","Владимировна","Владиславовна","Вячеславовна","Гаврииловна","Геннадьевна","Георгиевна","Глебовна","Григорьевна","Данииловна","Даниловна","Денисовна","Дмитриевна","Евгеньевна","Егоровна","Кирилловна","Ивановна","Игоревна","Ильинична","Иннокентьевна","Львовна","Леонидовна","Максимовна","Матвеевна","Михайловна","Никитична","Николаевна","Олеговна","Павловна","Петровна","Романовна","Ростиславовна","Руслановна","Семёновна","Святославовна","Сергеевна","Станиславовна","Степановна","Тимофеевна","Тимуровна","Фёдоровна","Филипповна","Эдуардовна","Юрьевна","Яковлевна","Ярославовна"],
        ],
        'last' => [
            'm' => ["Смирнов","Иванов","Кузнецов","Новиков","Морозов","Петров","Павлов","Семёнов","Богданов","Воробьёв","Тарасов","Белов","Киселёв","Макаров","Андреев","Ковалёв","Ильин","Гусев","Титов","Кузьмин","Кудрявцев","Баранов","Куликов","Алексеев","Степанов","Яковлев","Сорокин","Сергеев","Романов","Захаров","Борисов","Королёв","Герасимов","Пономарёв","Григорьев","Лазарев","Ершов","Никитин","Соболев","Рябов","Цветков","Данилов","Журавлёв","Николаев","Крылов","Максимов","Сидоров","Осипов","Белоусов","Федотов","Дорофеев","Егоров","Матвеев","Бобров","Дмитриев","Анисимов","Антонов","Тимофеев","Никифоров","Веселов","Филиппов","Марков","Большаков","Суханов","Миронов","Ширяев","Александров","Коновалов","Шестаков","Казаков","Громов","Фомин","Давыдов","Мельников","Щербаков","Блинов","Колесников","Афанасьев","Власов","Исаков","Тихонов","Аксёнов","Родионов","Котов","Зуев","Панов","Рыбаков","Абрамов","Воронов","Мухин","Архипов","Трофимов","Горшков","Овчинников","Панфилов","Копылов","Лобанов","Лукин","Беляков","Потапов","Некрасов","Хохлов","Жданов","Наумов","Шилов","Воронцов","Ермаков","Дроздов","Игнатьев","Савин","Логинов","Сафонов","Капустин","Кириллов","Моисеев","Елисеев","Кошелев","Костин","Горбачёв","Орехов","Ефремов","Исаев","Евдокимов","Калашников","Кабанов","Носков","Юдин","Кулагин","Лапин","Прохоров","Нестеров","Харитонов","Агафонов","Муравьёв","Ларионов","Федосеев","Зимин","Пахомов","Шубин","Игнатов","Филатов","Крюков","Рогов","Кулаков","Терентьев","Молчанов","Владимиров","Артемьев","Гурьев","Зиновьев","Гришин","Кононов","Дементьев","Ситников","Симонов","Мишин","Фадеев","Комиссаров","Мамонтов","Носов","Гуляев","Шаров","Устинов","Вишняков","Евсеев","Лаврентьев","Брагин","Константинов","Корнилов","Авдеев","Зыков","Бирюков","Шарапов","Никонов","Щукин","Дьячков","Одинцов","Сазонов","Якушев","Красильников","Гордеев","Самойлов","Князев","Беспалов","Уваров","Шашков","Бобылёв","Доронин","Белозёров","Рожков","Самсонов","Мясников","Лихачёв","Буров","Сысоев","Фомичёв","Русаков","Стрелков","Гущин","Тетерин","Колобов","Субботин","Фокин","Блохин","Селиверстов","Пестов","Кондратьев","Силин","Меркушев","Лыткин","Туров"],
            'f' => ["Смирнова","Иванова","Кузнецова","Новикова","Морозова","Петрова","Павлова","Семёнова","Богданова","Воробьёва","Тарасова","Белова","Киселёва","Макарова","Андреева","Ковалёва","Ильина","Гусева","Титова","Кузьмина","Кудрявцева","Баранова","Куликова","Алексеева","Степанова","Яковлева","Сорокина","Сергеева","Романова","Захарова","Борисова","Королёва","Герасимова","Пономарёва","Григорьева","Лазарева","Ершова","Никитина","Соболева","Рябова","Цветкова","Данилова","Журавлёв","Николаева","Крылова","Максимова","Сидорова","Осипова","Белоусова","Федотова","Дорофеева","Егорова","Матвеева","Боброва","Дмитриева","Анисимова","Антонова","Тимофеева","Никифорова","Веселова","Филиппова","Маркова","Большакова","Суханова","Миронова","Ширяева","Александрова","Коновалова","Шестакова","Казакова","Громова","Фомина","Давыдова","Мельникова","Щербакова","Блинова","Колесникова","Афанасьева","Власова","Исакова","Тихонова","Аксёнова","Родионова","Котова","Зуева","Панова","Рыбакова","Абрамова","Воронова","Мухина","Архипова","Трофимова","Горшкова","Овчинникова","Панфилова","Копылова","Лобанов","Лукина","Белякова","Потапова","Некрасова","Хохлова","Жданова","Наумова","Шилова","Воронцова","Ермакова","Дроздова","Игнатьева","Савина","Логинова","Сафонова","Капустина","Кириллова","Моисеева","Елисеева","Кошелева","Костина","Горбачёва","Орехова","Ефремова","Исаева","Евдокимова","Калашникова","Кабанова","Носкова","Юдина","Кулагина","Лапина","Прохорова","Нестерова","Харитонова","Агафонова","Муравьёва","Ларионова","Федосеева","Зимина","Пахомова","Шубина","Игнатова","Филатова","Крюкова","Рогова","Кулакова","Терентьева","Молчанова","Владимирова","Артемьева","Гурьева","Зиновьева","Гришина","Кононова","Дементьева","Ситникова","Симонова","Мишина","Фадеева","Комиссарова","Мамонтова","Носова","Гуляева","Шарова","Устинова","Вишнякова","Евсеева","Лаврентьева","Брагина","Константинова","Корнилова","Авдеева","Зыкова","Бирюкова","Шарапова","Никонова","Щукина","Дьячкова","Одинцова","Сазонова","Якушева","Красильникова","Гордеева","Самойлова","Князева","Беспалова","Уварова","Шашкова","Бобылёва","Доронина","Белозёрова","Рожкова","Самсонова","Мясникова","Лихачёва","Бурова","Сысоева","Фомичёва","Русакова","Стрелкова","Гущина","Тетерина","Колобова","Субботина","Фокина","Блохина","Селиверстова","Пестова","Кондратьева","Силина","Меркушева","Лыткина","Турова"],
        ],
    ];

    private $randomOrder;

    public function init(){
        parent::init();

        $this->randomOrder = 'RANDOM()';

        if(\Yii::$app->db->driverName == 'mysql'){
            $this->randomOrder = 'rand()';
        }
    }

    private function makeRandomName($type = 'fio', $sex = null, $space = ' '){
        if (!$sex) $sex = rand(0, 1) ? 'f' : 'm';
        switch ($type) {
            default:
            case 'fio':
                return
                    $this->makeRandomName('last', $sex) . $space
                    . $this->makeRandomName('name', $sex) . $space
                    . $this->makeRandomName('patro', $sex)
                    ;
            case 'name':
            case 'patro':
            case 'last':
                return $this->peoples[$type][$sex][array_rand($this->peoples[$type][$sex])];
        }
    }

    private function getQualificationId(){
        $query = (new \yii\db\Query())
            ->select('qualification_id')
            ->from(Qualification::tableName())
            ->orderBy($this->randomOrder)
            ->limit(1);

        $command = $query->createCommand();

        $qualification_id = $command->queryScalar();
        if(!$qualification_id){
            throw new \Exception('Get random qualification_id failed');
        }
        return $qualification_id;
    }

    private function getCityIds(){
        $query = (new \yii\db\Query())
            ->select('city_id')
            ->from(City::tableName())
            ->orderBy($this->randomOrder)
            ->limit(rand(1, 4));

        $command = $query->createCommand();

        $ids = $command->queryColumn();
        if(!$ids){
            throw new \Exception('Get random qualification_id failed');
        }
        return $ids;
    }

    private function createUser(){
        $Model = new User();
        $Model->qualification_id = $this->getQualificationId();
        $Model->name = $this->makeRandomName();

        if(!$Model->save(false)){
            throw new \Exception('Create user failed');
        }

        echo 'User #'.$Model->user_id.' created'. PHP_EOL;
        return $Model;
    }

    private function appendCities(User $User){
        $cities_ids = $this->getCityIds();

        for ($i = 0; $i < count($cities_ids); $i++) {
            $query = \Yii::$app->db->createCommand()
                ->insert('users_cities', [
                    'user_id' => $User->user_id,
                    'city_id' => $cities_ids[$i]
                ]);

            if(!$query->execute()){
                throw new \Exception('Link user #'.$User->user_id.' to city #'.$cities_ids[$i].' failed');
            }

            echo 'Link user #'.$User->user_id.' to city #'.$cities_ids[$i].' created', PHP_EOL;
        }
    }

    public function actionIndex($repeat = 1){
        $repeat = intval($repeat);
        for(; $repeat; $repeat--) {
            $User = $this->createUser();
            $this->appendCities($User);
        }
    }
}
