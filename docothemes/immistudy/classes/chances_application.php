<?php
//require_once('Mysql.php');
require_once('membership.php');

class ChancesApp {
	private $mysql;
	private $member;
	private $chancesData = array(
	          "goal" => "",
	          "name" => "",
	          "gender" => "",
	          "birthDate" => "",
	          "englishLevel" => "",
	          "email" => "",
	          "EduLevel" => "",
	          "birthYear" => ""
	);
	
	//This is the text for making part of immigration letter for a user
	private $immigration_additional_text = array(
		"Мужской" => array("«Специалист общего потока» Новая Зеландия", "«Специалист по программе Серебряный папоротник» Новая Зеландия", "«Специалист общего потока» Австралия", "«Специалист спонсируемого потока» Австралия", "«Специалист общего потока» Канада", "«Специалист номинируемого потока» Канада", "«Специалист рабочей профессии» Канада", "«Выдающийся талант» Австралия", "«Бизнес инвестор общего потока» Австралия", "«Бизнес инвестор территориального потока» Австралия", "«Бизнес инвестор общего потока» США", "«Бизнес инвестор пилотного проекта» США", "«Бизнес инвестор общего потока» Новая Зеландия", "«Бизнес инвестор пенсионного потока» Новая Зеландия", "«Бизнес предпринимательского потока» Новая Зеландия", "«Семейный поток» Австралия", "«Семейный поток» Новая Зеландия", "«Семейный поток» Канада", "«Семейный поток» США"),
		
		"Женский" => array("«Специалист общего потока» Новая Зеландия", "«Специалист по программе Серебряный папоротник» Новая Зеландия", "«Специалист общего потока» Австралия", "«Специалист спонсируемого потока» Австралия", "«Специалист общего потока» Канада", "«Специалист номинируемого потока» Канада", "«Специалист рабочей профессии» Канада", "«Выдающийся талант» Австралия", "«Бизнес инвестор общего потока» Австралия", "«Бизнес инвестор территориального потока» Австралия", "«Бизнес инвестор общего потока» США", "«Бизнес инвестор пилотного проекта» США", "«Бизнес инвестор общего потока» Новая Зеландия", "«Бизнес инвестор пенсионного потока» Новая Зеландия", "«Бизнес предпринимательского потока» Новая Зеландия", "«Семейный поток» Австралия", "«Семейный поток» Новая Зеландия", "«Семейный поток» Канада", "«Семейный поток» США", "«Брак с Французским гражданином» Франция"),
		
		"young" => array("«Специалист общего потока» Новая Зеландия", "«Специалист по программе Серебряный папоротник» Новая Зеландия", "«Специалист общего потока» Австралия", "«Специалист спонсируемого потока» Австралия", "«Специалист общего потока» Канада", "«Специалист номинируемого потока» Канада", "«Специалист рабочей профессии» Канада", "«Выдающийся талант» Австралия", "«Бизнес инвестор общего потока» Австралия", "«Бизнес инвестор территориального потока» Австралия", "«Бизнес инвестор общего потока» США", "«Бизнес инвестор пилотного проекта» США", "«Бизнес инвестор общего потока» Новая Зеландия", "«Бизнес инвестор пенсионного потока» Новая Зеландия", "«Бизнес предпринимательского потока» Новая Зеландия", "«Семейный поток» Австралия", "«Семейный поток» Новая Зеландия", "«Семейный поток» Канада", "«Семейный поток» США", "«Брак с Французским гражданином» Франция"),
		
		"medium" => array("«Специалист общего потока» Новая Зеландия","«Специалист общего потока» Австралия","«Специалист спонсируемого потока» Австралия",
		                         "«Специалист общего потока» Канада",
		                         "«Специалист номинируемого потока» Канада",
		                         '«Специалист рабочей профессии» Канада',
		                         '«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США',
		                         '«Брак с Французским гражданином» Франция'
		),
		
		'old' => array('«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США',
		                         '«Выдающийся талант» Австралия'
		),
		
		'Fluent' => array('«Специалист общего потока» Новая Зеландия',
		                         '«Специалист по программе Серебряный папоротник» Новая Зеландия',
		                         '«Специалист общего потока» Австралия',
		                         '«Специалист спонсируемого потока» Австралия',
		                         '«Специалист общего потока» Канада',
		                         '«Специалист номинируемого потока» Канада',
		                         '«Специалист рабочей профессии» Канада',
		                         '«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США'
		),
		
		'Conversational' => array('«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США'
		),
		
		'Limited' => array('«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США'
		),
		
		'No' => array('«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия'
		),
		
		'Среднее' => array('«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США',
		                         '«Брак с Французским гражданином» Франция'
		),
		
		'Среднее специальное профессиональное' => array('«Специалист общего потока» Канада',
		                         '«Специалист номинируемого потока» Канада',
		                         '«Специалист рабочей профессии» Канада',
		                         '«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США',
		                         '«Брак с Французским гражданином» Франция'
		),
		
		'Высшее профессиональное' => array('«Специалист общего потока» Новая Зеландия',
		                         '«Специалист по программе Серебряный папоротник» Новая Зеландия',
		                         '«Специалист общего потока» Австралия',
		                         '«Специалист спонсируемого потока» Австралия',
		                         '«Специалист общего потока» Канада',
		                         '«Специалист номинируемого потока» Канада',
		                         '«Специалист рабочей профессии» Канада',
		                         '«Выдающийся талант» Австралия',
		                         '«Бизнес инвестор общего потока» Австралия',
		                         '«Бизнес инвестор территориального потока» Австралия',
		                         '«Бизнес инвестор общего потока» США',
		                         '«Бизнес инвестор пилотного проекта» США',
		                         '«Бизнес инвестор общего потока» Новая Зеландия',
		                         '«Бизнес инвестор пенсионного потока» Новая Зеландия',
		                         '«Бизнес предпринимательского потока» Новая Зеландия',
		                         '«Семейный поток» Австралия',
		                         '«Семейный поток» Новая Зеландия',
		                         '«Семейный поток» Канада',
		                         '«Семейный поток» США',
		                         '«Брак с Французским гражданином» Франция'
		)
	);
	
	private $work_additional_text = array(
		"Мужской" => array('Программа «Серебряный папоротник»',
		                     'Программа «Работа на круизных лайнерах»',
		                     'Программа «Работа в ОАЕ»',
		                     'Программа работы в Канаде',
		                     'Программа работы в Новой Зеландии'
		),
		
		"Женский" => array('Программа LCP (работа няни в Канаде)',
		                     'Программа «Серебряный папоротник»',
		                     'Программа «Работа на круизных лайнерах»',
		                     'Программа «Работа в ОАЕ»',
		                     'Программа работы в Канаде',
		                     'Программа работы в Новой Зеландии'
		),
		
		"21 to 30" => array('Программа LCP (работа няни в Канаде)',
		                     'Программа «Серебряный папоротник»',
		                     'Программа «Работа на круизных лайнерах»',
		                     'Программа «Работа в ОАЕ»',
		                     'Программа работы в Канаде',
		                     'Программа работы в Новой Зеландии'
		),
		
		"31 to 35" => array('Программа LCP (работа няни в Канаде)',
		                     'Программа «Серебряный папоротник»',
		                     'Программа «Работа в ОАЕ»',
		                     'Программа работы в Канаде',
		                     'Программа работы в Новой Зеландии'
		),
		
		"36 to 45" => array('Программа LCP (работа няни в Канаде)',
		                     'Программа работы в Канаде',
		                     'Программа работы в Новой Зеландии'
		),
		
		"46 to 49" => array('Программа работы в Канаде',
		                      'Программа работы в Новой Зеландии'
		),
		
		'Fluent' => array('Программа LCP (работа няни в Канаде)',
		                       'Программа «Серебряный папоротник»',
		                       'Программа «Работа на круизных лайнерах»',
		                       'Программа «Работа в ОАЕ»',
		                       'Программа работы в Канаде',
		                       'Программа работы в Новой Зеландии'
		),
		
		'Conversational' => array('Программа LCP (работа няни в Канаде)',
		                       'Программа «Работа на круизных лайнерах»',
		                       'Программа «Работа в ОАЕ»',
		                       'Программа работы в Канаде',
		                       'Программа работы в Новой Зеландии'
		),
		
		'Limited' => array('Программа «Работа в ОАЕ»',
		                        'Программа работы в Канаде',
		                        'Программа работы в Новой Зеландии'
		),
		
		'Среднее' => array('Программа LCP (работа няни в Канаде)',
		                        'Программа «Работа на круизных лайнерах»',
		                        'Программа «Работа в ОАЕ»'
		),
		
		'Среднее специальное профессиональное' => array('Программа LCP (работа няни в Канаде)',
		                        'Программа «Работа на круизных лайнерах»',
		                        'Программа «Работа в ОАЕ»',
		                        'Программа работы в Канаде',
		                        'Программа работы в Новой Зеландии'
		),
		
		'Высшее профессиональное' => array('Программа LCP (работа няни в Канаде)',
		                        'Программа «Серебряный папоротник»',
		                        'Программа «Работа на круизных лайнерах»',
		                        'Программа «Работа в ОАЕ»',
		                        'Программа работы в Канаде',
		                        'Программа работы в Новой Зеландии'
		)
	
	);
	
	private $education_additional_text = array(
		"Мужской" => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе поствысшего образования в США',
		                     'Обучение в университете на академической программе поствысшего образования в Канаде',
		                     'Обучение в университете на академической программе поствысшего образования в Австралии',
		                     'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		),
		
		"Женский" => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе поствысшего образования в США',
		                     'Обучение в университете на академической программе поствысшего образования в Канаде',
		                     'Обучение в университете на академической программе поствысшего образования в Австралии',
		                     'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		),
		
		"5 to 15" => array('Обучение в общеобразовательной школе в Австралии',
		                    'Обучение в общеобразовательной школе в Новой Зеландии',
		                    'Обучение в школе Английского языка в Канаде',
		                    'Обучение в школе Английского языка в Австралии',
		                    'Обучение в школе Английского языка в Новой Зеландии',
		                    'Обучение в школе Английского языка в США'
		),
		
		"16" => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии'
		),
		
		"17 to 44" => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии'
		),
		
		"45 and more" => array('Обучение в университете на академической программе поствысшего образования в США',
		                     'Обучение в университете на академической программе поствысшего образования в Канаде',
		                     'Обучение в университете на академической программе поствысшего образования в Австралии',
		                     'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		),
		
		'Fluent' => array('Обучение в общеобразовательной школе в Австралии',
		                  'Обучение в общеобразовательной школе в Новой Зеландии',
		                  'Обучение в школе Английского языка в Канаде',
		                  'Обучение в школе Английского языка в Австралии',
		                  'Обучение в школе Английского языка в Новой Зеландии',
		                  'Обучение в школе Английского языка в США',
		                  'Обучение в колледже на академической программе в США',
		                  'Обучение в колледже на академической программе в Канаде',
		                  'Обучение в колледже на академической программе в Австралии',
		                  'Обучение в колледже на академической программе в Новой Зеландии',
		                  'Обучение в университете на академической программе в США',
		                  'Обучение в университете на академической программе в Канаде', 
		                  'Обучение в университете на академической программе в Австралии',
		                  'Обучение в университете на академической программе в Новой Зеландии',
		                  'Обучение в университете на академической программе поствысшего образования в США',
		                  'Обучение в университете на академической программе поствысшего образования в Канаде',
		                  'Обучение в университете на академической программе поствысшего образования в Австралии',
		                  'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		),
		
		'Conversational' => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе поствысшего образования в США',
		                     'Обучение в университете на академической программе поствысшего образования в Канаде',
		                     'Обучение в университете на академической программе поствысшего образования в Австралии',
		                     'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		),
		
		'Limited' => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии'
		),
		
		'No' => array('Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США'
		),
		
		'Среднее' => array('Обучение в общеобразовательной школе в Австралии',
		                     'Обучение в общеобразовательной школе в Новой Зеландии',
		                     'Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии'
		),
		
		'Среднее специальное профессиональное' => array('Обучение в школе Английского языка в Канаде',
		                      'Обучение в школе Английского языка в Австралии',
		                      'Обучение в школе Английского языка в Новой Зеландии',
		                      'Обучение в школе Английского языка в США',
		                      'Обучение в колледже на академической программе в США',
		                      'Обучение в колледже на академической программе в Канаде',
		                      'Обучение в колледже на академической программе в Австралии',
		                      'Обучение в колледже на академической программе в Новой Зеландии',
		                      'Обучение в университете на академической программе в США',
		                      'Обучение в университете на академической программе в Канаде', 
		                      'Обучение в университете на академической программе в Австралии',
		                      'Обучение в университете на академической программе в Новой Зеландии'
		),
		
		'Высшее профессиональное' => array('Обучение в школе Английского языка в Канаде',
		                     'Обучение в школе Английского языка в Австралии',
		                     'Обучение в школе Английского языка в Новой Зеландии',
		                     'Обучение в школе Английского языка в США',
		                     'Обучение в колледже на академической программе в США',
		                     'Обучение в колледже на академической программе в Канаде',
		                     'Обучение в колледже на академической программе в Австралии',
		                     'Обучение в колледже на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе в США',
		                     'Обучение в университете на академической программе в Канаде', 
		                     'Обучение в университете на академической программе в Австралии',
		                     'Обучение в университете на академической программе в Новой Зеландии',
		                     'Обучение в университете на академической программе поствысшего образования в США',
		                     'Обучение в университете на академической программе поствысшего образования в Канаде',
		                     'Обучение в университете на академической программе поствысшего образования в Австралии',
		                     'Обучение в университете на академической программе поствысшего образования в Новой Зеландии'
		)
	);	
	
	//Default constructor
	public function __construct(){
		
	}
	
	//Singleton that instantiates the object of a class
	public static function chancesForm($chancesData){
		$instance = new self();
		$instance->set_chancesData($chancesData);
		return $instance;
	}

	//Helper function that sets the appliction values
	public function set_chancesData($chancesData){
		foreach ($chancesData as $key => $value) {
			if ( array_key_exists($key, $this->chancesData) ) $this->chancesData[$key] = $value;
		}
	}
	
	//This function puts submitted data into the database
	public function put_chancesData(){
		$this->mysql = new Mysql();
		return $this->mysql->chancesApp_form($this->chancesData);
	}
	
	//This function send an email with the evaluation letter
	public function send_eval_email(){
		$this->member = new Membership();
		$age_num = date("Y") - $this->chancesData['birthYear'];
		if($this->chancesData['goal'] == 'иммиграция'){
			$msg = "Добрый день!" . "\r\n";
			$msg .= "Спасибо за то, что вы обратились к нам с вопросом по иммиграции." . "\n";
			$msg .= "Выезд в  другую страну на постоянное место жительства смелый и ответственный шаг, поэтому очень важно правильно оценить свои возможности и затраты на осуществление своих планов." . "\r\n";
			$msg .= "Мы работаем с клиентами как удаленно (скайп, телефон, e-mail), так и в офисе. Многие наши клиенты живут в других городах и даже странах. По государственным иммиграционным программам мы работаем с такими странами как Канада, Австралия, Новая Зеландия, США." . "\r\n"; 
			$msg .= "Мы получили вашу предварительную анкету и на основании полученных данных мы считаем, что вы соответствуете требованиям следующих программ которые мы предлагаем: ";
			
			//gender of a user
			$gender = array_key_exists($this->chancesData['gender'], $this->immigration_additional_text) && !empty($this->immigration_additional_text[$this->chancesData['gender']])  
			         ? $this->immigration_additional_text[$this->chancesData['gender']] 
			         : 'non-existant or empty value key';
			
			if ($age_num <= 35){
				$age_key = 'young';
			} elseif ($age_num >= 36 && $age_num <= 55) {
				$age_key = 'medium';
			} else {
				$age_key = 'old';
			}
			//age of the user
			$age = array_key_exists($age_key, $this->immigration_additional_text) && !empty($this->immigration_additional_text[$age_key]) 
			        ? $this->immigration_additional_text[$age_key] 
			        : 'non-existant or empty value key';
			
			//knowledge of english
			$english = array_key_exists($this->chancesData['englishLevel'], $this->immigration_additional_text) 
					&& !empty($this->immigration_additional_text[ $this->chancesData['englishLevel'] ])  
			        ? $this->immigration_additional_text[ $this->chancesData['englishLevel'] ] 
			        : 'non-existant or empty value key';
			
			//education level of a user
			$education = array_key_exists($this->chancesData['EduLevel'], $this->immigration_additional_text) 
					&& !empty($this->immigration_additional_text[ $this->chancesData['EduLevel'] ])  
			        ? $this->immigration_additional_text[ $this->chancesData['EduLevel'] ] 
			        : 'non-existant or empty value key';        	
			
			//String part of the immigration letter
			$letter_part = implode( ", ", array_intersect($gender, $age, $english, $education) );
			$msg .= $letter_part; 
			
		} elseif ($this->chancesData['goal'] == 'обучение') {
			$msg = "Добрый день!" . "\r\n";
			$msg .= "Спасибо за то, что вы обратились к нам с вопросом получения образования за границей." . "\n";
			$msg .= "Выезд  в  другую страну для получения образования  ответственный шаг, поэтому очень важно правильно оценить свои возможности и затраты на осуществление своих планов." . "\r\n";
			$msg .= "Мы работаем с клиентами как удаленно (скайп, телефон, e-mail), так и в офисе. Многие наши клиенты живут в других городах и даже странах. По образовательным  программам мы работаем с учебными заведениями в таких странах как Канада, Австралия, Новая Зеландия, США." . "\r\n"; 
			$msg .= "Мы получили вашу предварительную анкету и на основании полученных данных мы считаем, что вы соответствуете требованиям следующих программ которые мы предлагаем: ";

			if ($age_num < 5 || $age_num > 44 && $this->chancesData['EduLevel'] != 'Высшее профессиональное') {
				$letter_part = "Нет подходящих программ";
			} else {
				//gender of a user
				$gender = array_key_exists($this->chancesData['gender'], $this->education_additional_text) && !empty($this->education_additional_text[$this->chancesData['gender']])  
				         ? $this->education_additional_text[$this->chancesData['gender']] 
				         : 'non-existant or empty value key';
				if ($age_num <= 15){
					$age_key = '5 to 15';
				} elseif ($age_num == 16) {
					$age_key = '16';
				} elseif ($age_num <= 44) {
					$age_key = '17 to 44';
				} else {
					$age_key = '45 and more';
				}
				
				//age of the user
				$age = array_key_exists($age_key, $this->education_additional_text) && !empty($this->education_additional_text[$age_key]) 
				        ? $this->education_additional_text[$age_key] 
				        : 'non-existant or empty value key';
				        
				//knowledge of english
				$english = array_key_exists($this->chancesData['englishLevel'], $this->education_additional_text) 
							&& !empty($this->education_additional_text[ $this->chancesData['englishLevel'] ])  
					        ? $this->education_additional_text[ $this->chancesData['englishLevel'] ] 
					        : 'non-existant or empty value key';
					        
				//education level of a user
				$education = array_key_exists($this->chancesData['EduLevel'], $this->education_additional_text) 
							&& !empty($this->education_additional_text[ $this->chancesData['EduLevel'] ])  
					        ? $this->education_additional_text[ $this->chancesData['EduLevel'] ] 
					        : 'non-existant or empty value key';	        
				
				//String part of the immigration letter
				$letter_part = implode( ", ", array_intersect($gender, $age, $english, $education) );
			}	
			$msg .= $letter_part;
		} elseif ($this->chancesData['goal'] == 'работа') {
			$msg = "Добрый день!" . "\r\n";
			$msg .= "Спасибо за то, что вы обратились к нам с вопросом получения работы за границей." . "\n";
			$msg .= "Выезд  в  другую страну для работы ответственный шаг, поэтому очень важно правильно оценить свои возможности и затраты на осуществление своих планов." . "\r\n";
			$msg .= "Мы работаем с клиентами как удаленно (скайп, телефон, e-mail), так и в офисе. Многие наши клиенты живут в других городах и даже странах. По партнерским программам получения  работы за рубежом мы работаем в таких странах как Канада (LCP), Новая Зеландия (Серебряный папоротник, Работа на Южном острове в Новой Зеландии), США (Круизные лайнеры),  ОАЕ (Отели высокого уровня), Франции (Au pair)." . "\r\n"; 
			$msg .= "Мы получили вашу предварительную анкету и на основании полученных данных мы считаем, что вы соответствуете требованиям следующих программ которые мы предлагаем: ";
			
			//if the user is yonger than 21 or older than 50 or doesn't know english then no work programs
			if ($age_num <= 21 || $age_num >= 50 || $this->chancesData['englishLevel'] == 'No') {
				$letter_part = "Нет подходящих программ";
			} else {	
				$gender = array_key_exists($this->chancesData['gender'], $this->work_additional_text) 
						&& !empty($this->work_additional_text[$this->chancesData['gender']])  
				         ? $this->work_additional_text[$this->chancesData['gender']] 
				         : 'non-existant or empty value key';
				if ($age_num <= 30){
					$age_key = '21 to 30';
				} elseif ($age_num <= 35) {
					$age_key = '31 to 35';
				} elseif ($age_num <= 45) {
					$age_key = '36 to 45';
				} elseif ($age_num <= 49) {
					$age_key = '46 to 49';
				}
				
				//age of the user
				$age = array_key_exists($age_key, $this->work_additional_text) && !empty($this->work_additional_text[$age_key]) 
				        ? $this->work_additional_text[$age_key] 
				        : 'non-existant or empty value key';
				        
				//knowledge of english
				$english = array_key_exists($this->chancesData['englishLevel'], $this->work_additional_text) 
						&& !empty($this->work_additional_text[ $this->chancesData['englishLevel'] ])  
				        ? $this->work_additional_text[ $this->chancesData['englishLevel'] ] 
				        : 'non-existant or empty value key';
				        
				//education level of a user
				$education = array_key_exists($this->chancesData['EduLevel'], $this->work_additional_text) 
						&& !empty($this->work_additional_text[ $this->chancesData['EduLevel'] ])  
				        ? $this->work_additional_text[ $this->chancesData['EduLevel'] ] 
				        : 'non-existant or empty value key';	        
			//String part of the immigration letter
			$letter_part = implode( ", ", array_intersect($gender, $age, $english, $education) );
			}	
			$msg .= $letter_part;	
		}
		
		$msg .= ".\r\n";
		$msg .= "
			Если вы заинтересованы продолжить наше сотрудничество, пожалуйста, регистрируйтесь на нашем сайте http://www.immistudy.ru/register 
			
			Наша работа состоит из трех этапов:
			
			I этап – Знакомство. У вас есть выбор: регистрация на нашей интернет страничке; заполнение предварительной анкеты; звонок к нам в офис по телефону/скайпу/с интернет странички; отправление письма по адресу immistudy@mail.ru 
			
			II этап – План.   Наши специалисты по иммиграционным программам составят детальный план вашего иммиграционного процесса, который даст вам возможность приехать в избранную вами страну наименее затратным и кратчайшим по времени путем. Мы сделаем это за 10 рабочих дней.
			
			III этап – Действие.   Если вы согласны с предложенным планом иммиграции, то мы приступим к его реализации. Наши специалисты будут сопровождать весь процесс до его конечной цели, т.е. получения вида на жительство для вас и всех членов вашей семьи. 
			
			С уважением, 
				Людмила Стехова, 
						директор агентства «immistudy.ru Иммиграция и образование»
			
		";
		
		return( $this->member->utility_email($msg, $this->chancesData["email"], "Оценка Ваших Шансов") );
	}
}