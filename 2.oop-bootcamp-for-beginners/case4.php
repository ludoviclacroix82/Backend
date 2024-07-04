<?php

declare(strict_types=1);


class Students
{

    private string $name;
    private float $grade;

    public function __construct(string $name, int $grade)
    {
        $this->name = $name;
        $this->grade = $grade;
    }

    private function getGrade()
    {
        return $this->grade;
    }

    public function getStudentsInfo()
    {
        return [
            'name' => $this->name,
            'grade' => $this->grade
        ];
    }

}

class Groups extends Students
{

    private int $num;
    public static int $totalGroup;

    public function __construct(int $num, string $name, int $grade)
    {
        parent::__construct($name, $grade);
        $this->num = $num;
    }

    public function getGroup(){

        return $this->num;
    }

    public function getStudentGroup(){
        return [
            'name' => $this->getStudentsInfo()['name'],
            'grade' => $this->getStudentsInfo()['grade'],
            'group' => $this->num
        ];

        self::calculedTotalGroup($this->getStudentsInfo()['grade']);
    }
    public static function calculedTotalGroup($note){

        // if(isset(self::$totalGroup[$this->num])){
        //     self::$totalGroup[$this->num] = 0;
        // }
        return self::$totalGroup += $note;
    }

    public function setChangeGroup( string $name, int $group){

    }
}

$studenstList = array(
    array("name" => "Alice", "grade" => 18, "group" => 1),
    array("name" => "Bob", "grade" => 15, "group" => 1),
    array("name" => "Charlie", "grade" => 12, "group" => 1),
    array("name" => "David", "grade" => 19, "group" => 1),
    array("name" => "Eve", "grade" => 16, "group" => 1),
    array("name" => "Frank", "grade" => 14, "group" => 1),
    array("name" => "Grace", "grade" => 17, "group" => 1),
    array("name" => "Harry", "grade" => 13, "group" => 1),
    array("name" => "Ivy", "grade" => 20, "group" => 1),
    array("name" => "Jack", "grade" => 11, "group" => 2),
    array("name" => "Karen", "grade" => 10, "group" => 2),
    array("name" => "Liam", "grade" => 9, "group" => 2),
    array("name" => "Mia", "grade" => 8, "group" => 2),
    array("name" => "Noah", "grade" => 7, "group" => 2),
    array("name" => "Olivia", "grade" => 6, "group" => 2),
    array("name" => "Peter", "grade" => 5, "group" => 2),
    array("name" => "Quinn", "grade" => 4, "group" => 2),
    array("name" => "Ryan", "grade" => 3, "group" => 2),
    array("name" => "Samantha", "grade" => 2, "group" => 2),
    array("name" => "Tyler", "grade" => 1, "group" => 2)
);

$groupSplit = [];

foreach ($studenstList  as $studentSplit) {
    $groupSplit[$studentSplit['group']][] = array(
        'name' => $studentSplit['name'],
        'grade' => $studentSplit['grade']
    );
}

//var_dump($groupSplit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
    <?php foreach ($groupSplit as $group => $students) : ?>
        <h2>Groupe <?= $group ?></h2>
        <ul>
        <?php foreach ($students as $student) : 
             $studentCreate = new Groups($group,$student['name'],$student['grade']);
            ?>
            <li><?= "{$studentCreate->getStudentGroup()['name']} - Grade : {$studentCreate->getStudentGroup()['grade']} "?></li>
        <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <?= Groups::$totalGroup; ?>
    </section>
</body>
</html>