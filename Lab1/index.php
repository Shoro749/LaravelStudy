<?php
// 1. Видалення всіх парних чисел із масиву.
// Створити масив із 15 випадкових чисел від 1 до 100. Видалити з нього всі парні числа.
$arr = [];
$arrFiltred = [];
$count = 15;

for ($i = 0; $i <= $count; $i++){
    $arr[] = rand (0, 100);
}

echo "Ex 1\n";
print_r($arr);

for ($i = 0; $i < $count; $i++){
    if ($arr[$i] % 2 !== 0){
        $arrFiltred[] = $arr[$i];
    }
}

echo "\nFiltred: ";
print_r($arrFiltred);

// 2.  Перевірити, чи масив є паліндромом. Користувач вводить масив чисел
// (через кому). Перевірити, чи цей масив є паліндромом (однаковий зліва направо і справа наліво).

echo "\nEx 2\nEnter numbers (example: 1, 2, 3, 2, 1): ";
$input = readline();
$array = array_map('trim', explode(',', $input));
$reversed = array_reverse($array);

if ($array === $reversed) {
    echo "\nPalindrome\n";
} else {
    echo "\nNot palindrome\n";
}

// 3.  Порахувати кількість парних чисел у масиві.
// Користувач вводить масив чисел. Вивести кількість парних елементів.

echo "\nEx 3\nEnter numbers: ";
$input = readline();
$arr = preg_split('/[\s,]+/', $input);

$count = 0;
foreach ($arr as $num) {
    if (is_numeric($num) && (int)$num % 2 === 0) {
        $count++;
    }
}
echo "\nNumber of paired elements: $count\n";

// 4.   Знайти числа кратні 4 у діапазоні. Знайти суму всіх чисел від 100 до 200, які кратні 4.

$sum = 0;
$numbers = [];

for ($i = 100; $i <= 200; $i++) {
    if ($i % 4 === 0) {
        $numbers[] = $i;
        $sum += $i;
    }
}

echo "\nEx 4\nNumbers multiple by 4: " . implode(", ", $numbers) . "\n";
echo "Sum: $sum\n";

// 5. Пошук другого за величиною елемента в масиві. Створити масив із 10 випадкових чисел
// від 0 до 50. Знайти друге за величиною число.

$arr = [];
$count = 10;
for ($i = 0; $i < $count; $i++) {
    $arr[] = rand(0, 50);
}
echo "\nEx 5\nArr: ";
print_r($arr);

$uniqueArray = array_unique($arr);
rsort($uniqueArray);

if (count($uniqueArray) >= 2) {
    echo "The second largest number: " . $uniqueArray[1] . "\n";
} else {
    echo "Not found.\n";
}

// 6. Підрахунок добутку непарних чисел масиву. Створити масив із 15 випадкових чисел від 1 до 100.
// Порахувати добуток лише непарних чисел.

$arr = [];
$count = 15;
for ($i = 0; $i < $count; $i++) {
    $arr[] = rand(1, 100);
}

echo "\nEx 6\n";
print_r($arr);

$product = 1;
$hasOdd = false;

foreach ($arr as $num) {
    if ($num % 2 !== 0) {
        $product *= $num;
        $hasOdd = true;
    }
}

if ($hasOdd) {
    echo "Product of odd numbers: $product\n";
} else {
    echo "There are no odd numbers in the array.\n";
}

// 7. Перетворення дати у текстовий формат. Користувач вводить дату у форматі день.місяць.рік
// (наприклад: 12.06.2025). Вивести її у вигляді: “12 червня 2025 року”.

echo "\nEx 7\nEnter date (dd.MM.yyyy): ";
$inputDate = readline();

$months = [
    1 => "January",
    2 => "February",
    3 => "March",
    4 => "April",
    5 => "May",
    6 => "June",
    7 => "July",
    8 => "August",
    9 => "September",
    10 => "October",
    11 => "November",
    12 => "December"
];

$parts = explode('.', $inputDate);
if (count($parts) === 3) {
    $d = (int)$parts[0];
    $m = (int)$parts[1];
    $y = (int)$parts[2];
    echo "Result: $d " . ($months[$m] ?? 'unknown month') . " $y year\n";
}

// 8. Знайти кількість елементів, кратних 100 у масиві. Створити масив із 20 випадкових чисел
// від 50 до 500. Порахувати, скільки з них кратні 100.

$arr = [];
$count = 20;

for ($i = 0; $i < $count; $i++){
    $arr[] = rand (50, 500);
}

echo "\nEx 8\n";
print_r($arr);

$counter = 0;

foreach ($arr as $value){
    if ($value % 100 === 0){
        $counter++;
    }
}

echo "\nMultiples of 100: ", $counter;

// 9. Вивід чисел, що діляться на 5, та обчислення їхньої суми. Розробіть програму, яка з числа 20 .. 45 знайде
// ті, які діляться на 5 і знайде суму цих чисел. Можна використовувати функцію fmod для визначення
// "ділиться число" або "не ділиться".

$sum = 0;
$foundNumbers = [];

for ($i = 20; $i <= 45; $i++) {
    if (fmod($i, 5) == 0) {
        $foundNumbers[] = $i;
        $sum += $i;
    }
}

echo "\nEx 9\nNumbers from 20 to 45 that are divisible by 5:\n";
print_r($foundNumbers);
echo "\nSum: $sum\n";

// 10. Робота світлофора запрограмована таким чином: з початку кожної години, протягом трьох хвилин горить зелений
// сигнал, наступні дві хвилини горить червоний, далі протягом трьох хвилин - зелений і т. д. Вам потрібно
// розробити програму, яка по введеному числу від 1 до 60 визначає якого кольору зараз горить сигнал.

echo "\nEx 10\nEnter minutes (1-60): ";
$minute = (int)readline();

if ($minute < 1 || $minute > 60) {
    echo "Enter number 1 to 60.\n";
} else {
    $cycleMinute = $minute % 5;

    if ($cycleMinute === 0) {
        $cycleMinute = 5;
    }

    if ($cycleMinute <= 3) {
        echo "Green light.\n";
    } else {
        echo "Red light.\n";
    }
}