<?php
//Appointment
?>

@extends('layouts.app')


@section('content')

<!-- Include js file for this view only -->







<div  class="container ">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="panel panel-default xo">
			
			
			    <!-- Flash message if Success -->
				@if(session()->has('flashMessageX'))
                    <div class="alert alert-success">
                        {!! session()->get('flashMessageX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message -->
				

                <!-- Flash message if Failed -->
				@if(session()->has('flashMessageFailX'))
                    <div class="alert alert-danger">
                        {!! session()->get('flashMessageFailX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message if Failed -->				
				

                <!-- Display form validation errors var 2 -->
				@if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->				
					
					
                <div class="panel-heading text-warning row">
				  <div class="col-sm-3 col-xs-6">
				    Appointment <span class="small text-danger">*</span> 
				  </div>  
				</div>





                <div class="panel-body appointment-x">
				
				    <div class="col-sm-12 col-xs-12">
                        <h1>Appointment</h1>
		            </div>	
				    
					
					<!-- Just info, may delete later -->
				    <div class="col-sm-12 col-xs-12 alert alert-info small font-italic text-danger  shadowX">
					    </br> Some notes here.....
						</br> Endpoint for making appointment, e.g visit to hairdresser, notary, dentist, etc
				        </br> 
					</div>
					
					
					
					<!----- Quoute  ----->
					<div class="col-sm-12 col-xs-12">
					    Table 1 => Table service - таблица содержит настройки для сервиса, который будет создаваться; mysql> describe service;
						<br>
+---------------+--------------+------+-----+---------+----------------+<br>
| Field         | Type         | Null | Key | Default | Extra          |<br>
+---------------+--------------+------+-----+---------+----------------+<br>
| id            | int          | NO   | PRI | NULL    | auto_increment |<br>
| name          | varchar(255) | NO   |     | NULL    |                |<br>
| location      | varchar(255) | YES  |     | NULL    |                |<br>
| description   | varchar(255) | YES  |     | NULL    |                |<br>
| event_link    | varchar(255) | NO   |     | NULL    |                |<br>
| event_color   | varchar(100) | YES  |     | NULL    |                |<br>
| start_period  | date         | NO   |     | NULL    |                |<br>
| end_period    | date         | NO   |     | NULL    |                |<br>
| duration      | time         | NO   |     | NULL    |                |<br>
| buffer_after  | time         | NO   |     | NULL    |                |<br>
| buffer_before | time         | NO   |     | NULL    |                |<br>
| max_customer  | int          | NO   |     | NULL    |                |<br>
| is_enable     | tinyint(1)   | NO   |     | NULL    |                |<br>
| type          | varchar(50)  | NO   |     | NULL    |                |<br>
| optimization  | varchar(50)  | YES  |     | NULL    |                |<br>
+---------------+--------------+------+-----+---------+----------------+<br>
<br><br><br><br>

Пример что содержится в таблице: mysql> select * from service; <br>
+----+---------+----------+-------------+------------+-------------+--------------+------------+----------+--------------+---------------+--------------+-----------+--------------+--------------+<br>
| id | name    | location | description | event_link | event_color | start_period | end_period | duration | buffer_after | buffer_before | max_customer | is_enable | type         | optimization |<br>
+----+---------+----------+-------------+------------+-------------+--------------+------------+----------+--------------+---------------+--------------+-----------+--------------+--------------+<br>
|  1 | Default | NULL     | NULL        | default    | NULL        | 2020-12-20   | 2021-02-19 | 00:40:00 | 00:00:00     | 00:00:00      |            1 |         1 | organization | distribution |<br>



<br><br><br><br>
Table 2 => Table intervals_rule - содержит график работ для сервиса:<br>
mysql> describe intervals_rule;<br>
+------------+-------------+------+-----+---------+----------------+<br>
| Field      | Type        | Null | Key | Default | Extra          |<br>
+------------+-------------+------+-----+---------+----------------+<br>
| id         | int         | NO   | PRI | NULL    | auto_increment |<br>
| service_id | int         | YES  | MUL | NULL    |                |<br>
| start_time | time        | NO   |     | NULL    |                |<br>
| end_time   | time        | NO   |     | NULL    |                |<br>
| name_day   | varchar(50) | NO   |     | NULL    |                |<br>
| type       | varchar(50) | NO   |     | NULL    |                |<br>
| date       | date        | YES  |     | NULL    |                |<br>
+------------+-------------+------+-----+---------+----------------+<br><br><br>
<br>
Пример что содержится в таблице intervals_rule<br>
mysql> select * from intervals_rule;<br>
+----+------------+------------+----------+----------+------+------+<br>
| id | service_id | start_time | end_time | name_day | type | date |<br>
+----+------------+------------+----------+----------+------+------+<br>
|  1 |          1 | 09:30:00   | 17:00:00 | Mon      | wday | NULL |<br>
|  2 |          1 | 09:30:00   | 17:00:00 | Tue      | wday | NULL |<br>
|  3 |          1 | 09:30:00   | 17:00:00 | Thu      | wday | NULL |<br>
|  4 |          1 | 09:30:00   | 17:00:00 | Wed      | wday | NULL |<br>
|  5 |          1 | 09:30:00   | 17:00:00 | Sat      | wday | NULL |<br>
|  6 |          1 | 09:30:00   | 17:00:00 | Sun      | wday | NULL |<br>
|  7 |          2 | 09:30:00   | 17:00:00 | Sun      | wday | NULL |<br>
+----+------------+------------+----------+----------+------+------+<br>
7 rows in set (0.00 sec)<br>
<br><br><br>

Table 3 => Table appointment - содержит клиентов, которые записались к сервису:<br>
mysql> describe appointment;<br>
+-------------+----------+------+-----+---------+----------------+<br>
| Field       | Type     | Null | Key | Default | Extra          |<br>
+-------------+----------+------+-----+---------+----------------+<br>
| id          | int      | NO   | PRI | NULL    | auto_increment |<br>
| service_id  | int      | YES  | MUL | NULL    |                |<br>
| employee_id | int      | YES  | MUL | NULL    |                |<br>
| id_customer | int      | YES  |     | NULL    |                |<br>
| notes       | longtext | YES  |     | NULL    |                |<br>
| start_time  | time     | NO   |     | NULL    |                |<br>
| end_time    | time     | NO   |     | NULL    |                |<br>
| date        | date     | NO   |     | NULL    |                |<br>
+-------------+----------+------+-----+---------+----------------+<br><br><br>

Пример что содержится в таблице:<br>
mysql> select * from appointment;<br>
+----+------------+-------------+-------------+--------+------------+----------+------------+<br>
| id | service_id | employee_id | id_customer | notes  | start_time | end_time | date       |<br>
+----+------------+-------------+-------------+--------+------------+----------+------------+<br>
|  1 |          1 |           1 |           5 | String | 12:00:00   | 12:40:00 | 2020-12-31 |<br>
+----+------------+-------------+-------------+--------+------------+----------+------------+<br><br><br>


С этими таблицами, с таким содержание, все работает хорошо. Все добавляется. Но проблема вот в чем. С такой бд я не смогу получить интервалы времени, которые заняты или свободны.
Для сведения, сервис содержит поле duration, которое описывает длительность работы "сеанса" с клиентом; на один и тот же момент времени может быть лишь один appointment(клиент).

Таблица intervals_rule имеет поля start_time, end_time это поля, которые показывают со скольки и до скольки работает сервис; name_day это имя дня(Mon, Thu, Tue, Wed,Fri,Sat,Sun). То есть таблица отвечает в какой день работает сервис и время работы сервиса.     
					</div><!----- End Quoute  ----->
					
				
				</div> <!-- end .appointment-x -->
				    
					
			
			
			
			
			
					
                
            </div> <!-- end .panel-default xo -->
        </div>
    </div>
</div> <!-- end . animate-bottom -->








@endsection
