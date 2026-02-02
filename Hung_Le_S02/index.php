<?php
// Bật hiển thị lỗi để dễ debug
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Session 02 Homework - Le Duc Hung</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; background-color: #f4f4f9; color: #333; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #4a90e2; }
        h2 { border-bottom: 2px solid #4a90e2; padding-bottom: 10px; margin-top: 40px; color: #333; }
        h3 { background: #eee; padding: 8px; border-left: 4px solid #4a90e2; margin-top: 20px; font-size: 1.1em; }
        .output { background: #2d3436; color: #81ecec; padding: 15px; border-radius: 5px; font-family: 'Courier New', monospace; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: #00b894; font-weight: bold; }
        .danger { color: #d63031; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>PHP SESSION 02 - COMPREHENSIVE CHALLENGES</h1>
    <p>Student: Le Duc Hung | Course: INS3064</p>

    <!-- ================================================================ -->
    <!-- PART 1: WARM-UP EXERCISES -->
    <!-- ================================================================ -->
    <h2>PART 1: WARM-UP EXERCISES</h2>

    <h3>01. Hello Strings</h3>
    <div class="output">
        <?php
        $name = "Alice";
        $city = "Paris";
        echo $name . " lives in " . $city . ".";
        ?>
    </div>

    <h3>02. Math Ops</h3>
    <div class="output">
        <?php
        $x = 10; 
        $y = 5;
        echo "Add: " . ($x + $y) . ", ";
        echo "Sub: " . ($x - $y) . ", ";
        echo "Mul: " . ($x * $y) . ", ";
        echo "Div: " . ($x / $y);
        ?>
    </div>

    <h3>03. Casting</h3>
    <div class="output">
        <?php
        $strNum = '25.50';
        $floatNum = (float)$strNum;
        $intNum = (int)$floatNum;
        echo gettype($floatNum) . "($floatNum), ";
        echo gettype($intNum) . "($intNum)";
        ?>
    </div>

    <h3>04. Truthiness</h3>
    <div class="output">
        <?php
        $isOnline = true;
        echo $isOnline ? "User is Online" : "User is Offline";
        ?>
    </div>

    <h3>05. Array Init</h3>
    <div class="output">
        <?php
        $fruits = ["Apple", "Banana", "Pear"];
        echo $fruits[1]; // Index 1 is the second item
        ?>
    </div>

    <h3>06. Sentence Builder</h3>
    <div class="output">
        <?php
        $sentence = "PHP";
        $sentence .= " is";
        $sentence .= " fun";
        echo $sentence;
        ?>
    </div>

    <h3>07. Strict Check</h3>
    <div class="output">
        <?php
        $val1 = 5;
        $val2 = '5';
        $loose = ($val1 == $val2) ? "True" : "False";
        $strict = ($val1 === $val2) ? "True" : "False";
        echo "Equal (==): $loose, Identical (===): $strict";
        ?>
    </div>

    <h3>08. Logic Gate</h3>
    <div class="output">
        <?php
        $age = 20;
        $hasTicket = true;
        if ($age > 18 && $hasTicket) {
            echo "Enter";
        } else {
            echo "Deny";
        }
        ?>
    </div>

    <!-- ================================================================ -->
    <!-- PART 2: CORE CHALLENGES -->
    <!-- ================================================================ -->
    <h2>PART 2: CORE CHALLENGES</h2>

    <h3>01. Grade Bot</h3>
    <div class="output">
        <?php
        $score = 85;
        if ($score >= 90) {
            echo "Grade: A";
        } elseif ($score >= 80) {
            echo "Grade: B";
        } elseif ($score >= 70) {
            echo "Grade: C";
        } else {
            echo "Grade: F";
        }
        ?>
    </div>

    <h3>02. Day Planner</h3>
    <div class="output">
        <?php
        $dayNum = 3;
        switch ($dayNum) {
            case 1: echo "Monday"; break;
            case 2: echo "Tuesday"; break;
            case 3: echo "Wednesday"; break;
            case 4: echo "Thursday"; break;
            case 5: echo "Friday"; break;
            case 6: echo "Saturday"; break;
            case 7: echo "Sunday"; break;
            default: echo "Invalid";
        }
        ?>
    </div>

    <h3>03. Multi-Table (Nested Loop)</h3>
    <div class="output">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                echo ($i * $j) . " ";
            }
            echo "<br>"; // New line after each row
        }
        ?>
    </div>

    <h3>04. Cart Total</h3>
    <div class="output">
        <?php
        $prices = [10, 20, 5];
        $total = 0;
        foreach ($prices as $price) {
            $total += $price;
        }
        echo "Total: $total";
        ?>
    </div>

    <h3>05. Countdown</h3>
    <div class="output">
        <?php
        $count = 10;
        while ($count >= 1) {
            echo "$count, ";
            $count--;
        }
        echo "Liftoff!";
        ?>
    </div>

    <h3>06. Even Filter</h3>
    <div class="output">
        <?php
        for ($i = 1; $i <= 20; $i++) {
            if ($i % 2 == 0) {
                echo "$i, ";
            }
        }
        ?>
    </div>

    <h3>07. Array Reverse (Manual)</h3>
    <div class="output">
        <?php
        $original = [1, 2, 3, 4, 5];
        $reversed = [];
        // Loop from the last index down to 0
        for ($i = count($original) - 1; $i >= 0; $i--) {
            $reversed[] = $original[$i];
        }
        print_r($reversed);
        ?>
    </div>

    <h3>08. FizzBuzz</h3>
    <div class="output">
        <?php
        for ($i = 1; $i <= 50; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                echo "FizzBuzz, ";
            } elseif ($i % 3 == 0) {
                echo "Fizz, ";
            } elseif ($i % 5 == 0) {
                echo "Buzz, ";
            } else {
                echo "$i, ";
            }
        }
        ?>
    </div>

    <!-- ================================================================ -->
    <!-- PART 3: FUNCTION CHALLENGES -->
    <!-- ================================================================ -->
    <h2>PART 3: FUNCTION CHALLENGES</h2>
    <?php
    // Functions definitions
    
    // 01 Greeter
    function greet(string $name): string {
        return "Hello, $name!";
    }

    // 02 Area Calc
    function area(float $w, float $h): float {
        return $w * $h;
    }

    // 03 Adult Check
    function isAdult(?int $age): bool {
        if ($age === null) return false;
        return $age >= 18;
    }

    // 04 Safe Divide
    function safeDiv(float $a, float $b): ?float {
        if ($b == 0) return null;
        return $a / $b;
    }

    // 05 Formatter
    function fmt(float $amt, string $c = '$'): string {
        return $c . number_format($amt, 2);
    }

    // 06 Pure Math
    function add(int $a, int $b): int {
        return $a + $b;
    }
    ?>

    <h3>Test Function Outputs:</h3>
    <div class="output">
        <p><strong>01 Greeter:</strong> <?= greet("Sam") ?></p>
        <p><strong>02 Area:</strong> <?= area(5.5, 2) ?></p>
        <p><strong>03 Adult Check (null):</strong> <?= isAdult(null) ? 'True' : 'False' ?></p>
        <p><strong>03 Adult Check (20):</strong> <?= isAdult(20) ? 'True' : 'False' ?></p>
        <p><strong>04 Safe Divide (10, 0):</strong> <?= var_export(safeDiv(10, 0), true) ?></p>
        <p><strong>04 Safe Divide (10, 2):</strong> <?= safeDiv(10, 2) ?></p>
        <p><strong>05 Formatter:</strong> <?= fmt(50) ?></p>
        <p><strong>06 Pure Math:</strong> <?= add(5, 7) ?></p>
    </div>

    <!-- ================================================================ -->
    <!-- PART 4: MINI PROJECTS -->
    <!-- ================================================================ -->
    <h2>PART 4: MINI PROJECTS</h2>

    <!-- 01 BMI Calculator -->
    <h3>01. BMI Calculator</h3>
    <div class="output">
        <?php
        function calculateBMI($kg, $m) {
            $bmi = $kg / ($m * $m);
            $bmiFormatted = round($bmi, 1);
            $category = "";
            
            if ($bmi < 18.5) {
                $category = "Underweight";
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $category = "Normal";
            } else {
                $category = "Overweight";
            }
            return "BMI: $bmiFormatted ($category)";
        }
        
        echo calculateBMI(100, 1.52);
        ?>
    </div>

    <!-- 02 Student List -->
    <h3>02. Student List</h3>
    <div class="output" style="background: white; color: black;">
        <?php
        $students = [
            ['name' => 'Nguyen Van A', 'grade' => 85],
            ['name' => 'Tran Thi B', 'grade' => 92],
            ['name' => 'Le Van C', 'grade' => 78],
            ['name' => 'Pham Thi D', 'grade' => 65]
        ];
        ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['grade'] ?></td>
                    <td>
                        <?= $student['grade'] >= 50 
                            ? "<span class='success'>Pass</span>" 
                            : "<span class='danger'>Fail</span>" 
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- 03 Prime Seeker -->
    <h3>03. Prime Seeker (1-100)</h3>
    <div class="output">
        <?php
        function isPrime($n): bool {
            if ($n < 2) return false;
            for ($i = 2; $i <= sqrt($n); $i++) {
                if ($n % $i == 0) return false;
            }
            return true;
        }

        $primes = [];
        for ($i = 1; $i <= 100; $i++) {
            if (isPrime($i)) {
                $primes[] = $i;
            }
        }
        echo implode(", ", $primes);
        ?>
    </div>

    <!-- 04 Scoreboard -->
    <h3>04. Scoreboard</h3>
    <div class="output">
        <?php
        $scores = [45, 80, 90, 60, 75, 88, 92, 55];
        
        // Calculations
        $max = max($scores);
        $min = min($scores);
        $avg = array_sum($scores) / count($scores);
        
        // Filter top performers (Above Average)
        $topPerformers = array_filter($scores, function($s) use ($avg) {
            return $s > $avg;
        });

        echo "Min: $min | Max: $max | Average: " . round($avg, 2) . "<br>";
        echo "Top Performers (> Avg): " . implode(", ", $topPerformers);
        ?>
    </div>

</div>

</body>
</html>