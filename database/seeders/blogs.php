<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class blogs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert(array(
		array(
		'title' => "למידה, חברות וכי ",
		'title' => ' Learning, friendships and that'
 		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog2.jpg',
		'category_id' => 1,
		'slug' => learning-friendships-and-that
		),
		array(
		'title' => "למידה, חברות וכי ",
		'title' => '  Size, membership and data'
		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog4.jpg',
		'category_id' => 4
		'slug' => size-membership-and-data
		),
		array(
		'title' => "למידה, חברות וכי ",
		'title' => '  Size, membership that'
		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog2.jpg',
		'category_id' => 1
		'slug' => size-membership-that
		),
		array(
		'title' => "למידה, חברות וכי ",
		'title' => ' Information, membership and that point'
		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog1.jpg',
		'category_id' => 3
		'slug' => information-membership-and-that-point
		),
		array(
		'title' => "למידה, חברות וכי ",
		'title' => ' Learning, friendships and that'
		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog3.jpg',
		'category_id' => 2
		'slug' => learning-friendships-that
		),
		array(
		'title' => "למידה, חברות וכי ",
		'title' => ' Size, membership'
		'content' => ' איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז, כאשר מדפסת לא ידועה לקחה מטבע מסוג וסיבבה אותו כדי ליצור ספר דגימה. ',
		'image' => 'blog1.jpg',
		'category_id' => 5
		'slug' => size-membership,
		'reading_time' => 
		),

		));
    }
}
