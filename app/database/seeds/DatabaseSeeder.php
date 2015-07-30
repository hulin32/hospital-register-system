<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('HospitalTableSeeder');
		$this->call('HospitalInformationTableSeeder');
		$this->call('DepartmentTableSeeder');
		$this->call('TitleTableSeeder');
		$this->call('DoctorTableSeeder');
		$this->call('RegisterAccountTableSeeder');
		$this->call('RegisterRecordTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('FeedbackTableSeeder');
		$this->call('ScheduleTableSeeder');
		$this->call('PeriodTableSeeder');
	}	

}
