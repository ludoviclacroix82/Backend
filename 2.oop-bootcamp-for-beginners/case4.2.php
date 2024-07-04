<?php

declare(strict_types=1);

class Student
{
    private string $name;
    private int $grade;
    private int $group;

    public function __construct(string $name, int $grade, int $group)
    {
        $this->name = $name;
        $this->grade = $grade;
        $this->group = $group;
    }

    public function getGrade(): int
    {
        return $this->grade;
    }

    public function getStudentInfo(): array
    {
        return [
            'name' => $this->name,
            'grade' => $this->grade,
            'group' => $this->group
        ];
    }
}

class Group
{
    private int $num;
    private array $students = [];

    public function __construct(int $num)
    {
        $this->num = $num;
    }

    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function getGroupNumber(): int
    {
        return $this->num;
    }

    public function getAverageGrade(): float
    {
        $total = 0;
        foreach ($this->students as $student) {
            $total += $student->getGrade();
        }
        $count = count($this->students);
        if ($count > 0) {
            return $total / $count;
        } else {
            return 0;
        }
    }
}

$studentsData = [
    ["name" => "Alice", "grade" => 18, "group" => 1],
    ["name" => "Bob", "grade" => 15, "group" => 1],
    ["name" => "Charlie", "grade" => 12, "group" => 1],
    ["name" => "David", "grade" => 19, "group" => 1],
    ["name" => "Eve", "grade" => 16, "group" => 1],
    ["name" => "Frank", "grade" => 14, "group" => 1],
    ["name" => "Grace", "grade" => 17, "group" => 1],
    ["name" => "Harry", "grade" => 13, "group" => 1],
    ["name" => "Ivy", "grade" => 20, "group" => 1],
    ["name" => "Jack", "grade" => 11, "group" => 2],
    ["name" => "Karen", "grade" => 10, "group" => 2],
    ["name" => "Liam", "grade" => 9, "group" => 2],
    ["name" => "Mia", "grade" => 8, "group" => 2],
    ["name" => "Noah", "grade" => 7, "group" => 2],
    ["name" => "Olivia", "grade" => 6, "group" => 2],
    ["name" => "Peter", "grade" => 5, "group" => 2],
    ["name" => "Quinn", "grade" => 4, "group" => 2],
    ["name" => "Ryan", "grade" => 3, "group" => 2],
    ["name" => "Samantha", "grade" => 2, "group" => 2],
    ["name" => "Tyler", "grade" => 1, "group" => 2]
];

// Initialize groups array
$groups = [];

// Create groups and assign students
foreach ($studentsData as $studentData) {
    $groupNum = $studentData['group'];
    if (!isset($groups[$groupNum])) {
        $groups[$groupNum] = new Group($groupNum);
    }
    $student = new Student($studentData['name'], $studentData['grade'], $studentData['group']);
    $groups[$groupNum]->addStudent($student);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Average Grades</title>
</head>
<body>
    <section>
        <?php foreach ($groups as $group): ?>
            <h2>Group <?= $group->getGroupNumber() ?> Average Grade: <?= round($group->getAverageGrade(), 2) ?></h2>
            <ul>
                <?php foreach ($group->getStudents() as $student): ?>
                    <li><?= $student->getStudentInfo()['name'] ?> - Grade: <?= $student->getStudentInfo()['grade'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </section>
</body>
</html>
