<?php

class Calendar extends CI_Controller{

	function index($year=false,$month=false){
		$prefs = array(
				'show_next_prev' => TRUE,
				'next_prev_url' => base_url().'calendar/index/'
			);

		//option template styling of calendar, this isnt needed unless we wanna style it
		$prefs['template'] = '

						   {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

						   {heading_row_start}<tr style="background: #dfdfdf;">{/heading_row_start}

						   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
						   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
						   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

						   {heading_row_end}</tr>{/heading_row_end}

						   {week_row_start}<tr>{/week_row_start}
						   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
						   {week_row_end}</tr>{/week_row_end}

						   {cal_row_start}<tr>{/cal_row_start}
						   {cal_cell_start}<td>{/cal_cell_start}

						   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
						   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

						   {cal_cell_no_content}{day}{/cal_cell_no_content}
						   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

						   {cal_cell_blank}&nbsp;{/cal_cell_blank}

						   {cal_cell_end}</td>{/cal_cell_end}
						   {cal_row_end}</tr>{/cal_row_end}

						   {table_close}</table>{/table_close}
						';


		if($year==false){
			$year = date('Y'); //current year, if no year was sent via $_GET
		}
		if($month==false){
			$month = date('m'); //current month
		}
		$this->load->library('calendar', $prefs); //it'll work without loading the $prefs, but we need to customize it so lets pass $prefs
		$data = array(
				3 => base_url().'posts/post/13',
				26 => base_url().'posts/post/4'
			); //example, how to add links to specific calendar days
		echo $this->calendar->generate($year,$month,$data);
	}
}