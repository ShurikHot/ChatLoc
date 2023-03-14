<?php
require_once 'D:\OpenServer\domains\chat.loc\vendor\db.php';
require_once 'D:\OpenServer\domains\chat.loc\assets\faker\src\autoload.php';

$faker = Faker\Factory::create();

$rand_count = rand(10, 200);

for ($i=1; $i < $rand_count; $i++) {
    $email = $faker->email;
    $name = $faker->name;
    $nickname = $faker->userName;
    $password = $faker->md5;
    $phone_num = $faker->numberBetween(1000000000, 9999999999);
    $gender = $faker->randomElement($array = array ('male', 'female', 'no_select'));
    $country = $faker->country;
    $language = $faker->randomElement($array = array ('ua', 'en'));
    $specialization = $faker->randomElement($array = array ('c_science','inf_technology','c_architecture','t_communication'));
    $comment = $faker->realText($maxNbChars = 50, $indexSize = 2);
    $date = $faker->dateTimeBetween('2023-01-01', '2023-03-10')->format('Y-m-d') . " " . $faker->time($format = 'H:i:s', $max = 'now');

    $query = mysqli_query($connect,
        "INSERT INTO `members` (`email`, `name`, `nickname`, `password`, `phone_num`, `gender`, `country`, `language`, `specialization`, `comment`, `created_at`)
               VALUES ('$email', '$name', '$nickname', '$password', '$phone_num', '$gender', '$country', '$language', '$specialization', '$comment', '$date')");
}
header('Location: ../../vendor/admin/admin_content.php?content=' . $_SESSION['user']['admin_category']);
