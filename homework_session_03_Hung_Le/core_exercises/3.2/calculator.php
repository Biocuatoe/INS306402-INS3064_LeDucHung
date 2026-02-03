<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $op = $_POST['operator'] ?? '+';

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Please enter valid numbers.";
    } else {
        switch ($op) {
            case '+': $res = $num1 + $num2; break;
            case '-': $res = $num1 - $num2; break;
            case '*': $res = $num1 * $num2; break;
            case '/':
                if ($num2 == 0) {
                    $error = "Cannot divide by zero.";
                } else {
                    $res = $num1 / $num2;
                }
                break;
            default: $error = "Invalid operator";
        }
        
        if (empty($error)) {
            $result = "$num1 $op $num2 = $res";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Arithmetic Calculator</h2>
    <form method="post">
        <input type="number" step="any" name="num1" required value="<?= htmlspecialchars($_POST['num1'] ?? '') ?>">
        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" step="any" name="num2" required value="<?= htmlspecialchars($_POST['num2'] ?? '') ?>">
        <button type="submit">Calculate</button>
    </form>
    
    <?php if($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php elseif($result): ?>
        <p style="color:green; font-weight:bold"><?= $result ?></p>
    <?php endif; ?>
</body>
</html>