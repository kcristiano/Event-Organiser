<?php

class recurrenceTest extends EO_UnitTestCase
{
	
    public function testOneOff()
    {
    	$_event_data = array(
    		'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    		'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() )
    	);
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    	);
    	
    	$this->assertEquals( $expected, $event_data['occurrences'] );
		
    }

    
    public function testDaily()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'daily',
    			'frequency' => 2,
    			'until' => new DateTime( '2013-11-02 20:19:00', eo_get_blog_timezone() ),
    			
    	);
    	
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-24 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-26 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-28 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-30 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-01 19:19:00', eo_get_blog_timezone() )
    	);
    	 
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    
    }
    
    public function testWeekly()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'weekly',
    			'schedule_meta' => array( 'WE', 'FR' ),
    			'until' => new DateTime( '2013-11-02 20:19:00', eo_get_blog_timezone() ),
    			 
    	);
    	 
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-23 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-25 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-30 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-01 19:19:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    
    }
    
    public function testWeeklyWithoutMeta()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'weekly',
    			'until' => new DateTime( '2013-11-02 20:19:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-29 19:19:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    	
    	$this->assertEquals( array( 'TU' ), $event_data['schedule_meta'] );
    
    }
    
    public function testWeeklyLimitedData()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'weekly',
    			'until' => new DateTime( '2013-11-02 20:19:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-29 19:19:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    
    }

    
    public function testMonthlyByMonthDay()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'monthly',
    			'schedule_meta' => 'BYMONTHDAY',
    			'until' => new DateTime( '2014-01-22 19:19:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-12-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2014-01-22 19:19:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testMonthlyByDay()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'monthly',
    			'schedule_meta' => 'BYDAY=4WE',
    			'until' => new DateTime( '2014-01-22 19:19:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			new DateTime( '2013-11-27 19:19:00', eo_get_blog_timezone() ), //4th Wednesday
    			new DateTime( '2013-12-25 19:19:00', eo_get_blog_timezone() ), //4th Wednesday
    			new DateTime( '2014-01-22 19:19:00', eo_get_blog_timezone() ), //4th Wednesday
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testYearly()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 2,
    			'until' => new DateTime( '2017-10-22 19:19:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2015-10-22 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2017-10-22 19:19:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testCustom()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 2,
    			'include' => array(
    				new DateTime( '2013-10-24 19:19:00', eo_get_blog_timezone() ),
    				new DateTime( '2013-11-17 19:19:00', eo_get_blog_timezone() ),
    				new DateTime( '2013-12-06 19:19:00', eo_get_blog_timezone() ),
    			)
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    		new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
			new DateTime( '2013-10-24 19:19:00', eo_get_blog_timezone() ),
    		new DateTime( '2013-11-17 19:19:00', eo_get_blog_timezone() ),
    		new DateTime( '2013-12-06 19:19:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testLeapYear()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2012-02-29 00:00:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2012-02-29 23:59:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 1,
    			'until' => new DateTime( '2020-02-29 00:00:00', eo_get_blog_timezone() ),
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2012-02-29 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2016-02-29 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2020-02-29 00:00:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testShortMonth()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2012-10-31 00:00:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2012-10-31 23:59:00', eo_get_blog_timezone() ),
    			'schedule' => 'monthly',
    			'frequency' => 1,
    			'until' => new DateTime( '2013-03-31 00:00:00', eo_get_blog_timezone() ),
    			'schedule_meta' => 'BYMONTHDAY',
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2012-10-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2012-12-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-01-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-03-31 00:00:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }

    
    public function testNoOccurrences()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'exclude' => array(
    				new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    			)
    	);
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	 
    	$this->assertInstanceOf( 'WP_Error', $event_data );
    }
    
    
    public function testNumberOccurrences()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-11-01 00:00:00', eo_get_blog_timezone() ),
    			'end' => new DateTime( '2013-11-01 23:59:00', eo_get_blog_timezone() ),
    			'schedule' => 'daily',
    			'frequency' => 3,
    			'number_occurrences' => 3,
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-11-01 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-04 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-07 00:00:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    public function testNumberOccurrencesWeekly(){
    	
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'weekly',
    			'schedule_meta' => array( 'WE', 'FR' ),
    			'number_occurrences' => 5,
    	);
    	
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-23 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-25 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-10-30 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-01 19:19:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-11-06 19:19:00', eo_get_blog_timezone() ),
    	);
    	
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    	
    } 
    
    public function testNumberOccurrencesYearly(){
    	 
    	$_event_data = array(
    			'start' => new DateTime( '2012-02-29 00:00:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2012-02-29 23:59:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 1,
    			'number_occurrences' => 4,
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2012-02-29 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2016-02-29 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2020-02-29 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2024-02-29 00:00:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    	 
    }
    
    public function testNumberOccurrencesYearlyShortMonth()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2012-10-31 00:00:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2012-10-31 23:59:00', eo_get_blog_timezone() ),
    			'schedule' => 'monthly',
    			'frequency' => 1,
    			'number_occurrences' => 4,
    			'schedule_meta' => 'BYMONTHDAY',
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2012-10-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2012-12-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-01-31 00:00:00', eo_get_blog_timezone() ),
    			new DateTime( '2013-03-31 00:00:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    
    
    public function testInvalidIncludes()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 2,
    			'include' => array(
    				new DateTime( '2013-10-24 19:19:00', eo_get_blog_timezone() ),
    				0,
    				new DateTime( '2013-12-06 19:19:00', eo_get_blog_timezone() ),
    			)
    
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    		new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
			new DateTime( '2013-10-24 19:19:00', eo_get_blog_timezone() ),
    		new DateTime( '2013-12-06 19:19:00', eo_get_blog_timezone() ),
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
    

    public function testReallyInvalidIncludes()
    {
    	$_event_data = array(
    			'start' => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ), //Tuesday
    			'end' => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    			'schedule' => 'yearly',
    			'frequency' => 2,
    			'include' => false,
    	);
    
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	$expected = array(
    			new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() )
    	);
    
    	$this->assertEquals( $expected, $event_data['occurrences'] );
    }
  
    
	
    public function testScheduleLastUpdate()
    {
    	$event_data = array(
    		'start'         => new DateTime( '2013-10-22 19:19:00', eo_get_blog_timezone() ),
    		'end'           => new DateTime( '2013-10-22 20:19:00', eo_get_blog_timezone() ),
    	    'schedule'      => 'daily',
            'frequency'     => 2,
    		'until' => new DateTime( '2013-10-26 19:19:00', eo_get_blog_timezone() ),
    	);
    	$event = eo_insert_event( $event_data );
    	
    	eo_update_event( $event, array(
    		'include' => array( new DateTime( '2013-10-25 19:19:00', eo_get_blog_timezone() ) )
    	));
    	
    	$schedule = eo_get_event_schedule( $event );
    	
    	$this->assertEquals( 
    		new DateTime( '2013-10-26 19:19:00', eo_get_blog_timezone() ), 
    		$schedule['until'] 
    	);

    }
    	
    /**
     * Tests where an occurrence's start time.
     */
    public function testChangeDateTime()
    {
    	$_event_data = array(
    		'start'         => new DateTime( '2014-08-11 18:48:00', eo_get_blog_timezone() ),
    		'end'           => new DateTime( '2014-08-11 19:48:00', eo_get_blog_timezone() ),
    		'schedule'      => 'weekly',
    		'until' => new DateTime( '2014-09-01 18:48:00', eo_get_blog_timezone() ),
    		'include'       => array( new DateTime( '2014-08-25 22:48:00', eo_get_blog_timezone() ) ),
    		'exclude'       => array( new DateTime( '2014-08-25 18:48:00', eo_get_blog_timezone() ) ),
    	);
    	
    	$event_data = _eventorganiser_generate_occurrences( $_event_data );
    	
    	//echo print_r( $event_data );
    	$expected = array(
    			new DateTime( '2014-08-11 18:48:00', eo_get_blog_timezone() ),
    			new DateTime( '2014-08-18 18:48:00', eo_get_blog_timezone() ),
    			new DateTime( '2014-08-25 22:48:00', eo_get_blog_timezone() ),
    			new DateTime( '2014-09-01 18:48:00', eo_get_blog_timezone() ),
    	);
    	
    	$this->assertEquals( $expected, $event_data['occurrences'] );
		
    }

    public function testMoveOccurrence()
    {
    	$event = array(
    		'start'         => new DateTime( '2014-08-11 18:48:00', eo_get_blog_timezone() ),
    		'end'           => new DateTime( '2014-08-11 19:48:00', eo_get_blog_timezone() ),
    		'schedule'      => 'weekly',
    		'until' => new DateTime( '2014-09-01 18:48:00', eo_get_blog_timezone() ),
    	);
    
    	$event_id       = $this->factory->event->create( $event );
    	$occurrences    = eo_get_the_occurrences_of( $event_id );
    	$occurrence_ids = array_keys( $occurrences );
    	$occurrence_id  = $occurrence_ids[2];
    	 
    	//Move the occurrence
    	$new_start = new DateTime( '2014-08-26 15:48:00', eo_get_blog_timezone() );
    	$new_end   = new DateTime( '2014-08-26 16:48:00', eo_get_blog_timezone() );
    	$response = eventorganiser_move_occurrence( $event_id, $occurrence_id, $new_start, $new_end );
    	
    	//Test that this was successful    
    	$expected = $occurrences;
    	$expected[$occurrence_id] = array(
    		'start' => $new_start,
    		'end'   => $new_end,
    	);
    	$this->assertEquals( true, $response );
    	$this->assertEquals( $expected, eo_get_the_occurrences_of( $event_id ) );

    }
    
    public function testChangeDurationOfOccurrence()
    {
    	
    	$this->markTestSkipped(
    		'This feature has not been implemented yet.'
    	);
    	
    	$event = array(
    		'start'         => new DateTime( '2014-08-11 18:48:00', eo_get_blog_timezone() ),
    		'end'           => new DateTime( '2014-08-11 19:48:00', eo_get_blog_timezone() ),
    		'schedule'      => 'weekly',
    		'until' => new DateTime( '2014-09-01 18:48:00', eo_get_blog_timezone() ),
    	);
   
    	$event_id       = $this->factory->event->create( $event );
    	$occurrences    = eo_get_the_occurrences_of( $event_id );
    	$occurrence_ids = array_keys( $occurrences );
    	$occurrence_id  = $occurrence_ids[2]; 
    	
    	$start = $occurrences[$occurrence_id]['start'];
    	$new_end = clone $start;
    	$new_end->modify( '+2 hours' );
    
    	//Change duration of occurrence
    	$response = eventorganiser_move_occurrence( $event_id, $occurrence_id, $start, $new_end );
    	 
    	//Test that this was successful
    	$expected = $occurrences;
    	$expected[$occurrence_id] = array(
    		'start' => $start,
    		'end'   => $new_end,
    	);
    	$this->assertEquals( true, $response );
    	$this->assertEquals( $expected, eo_get_the_occurrences_of( $event_id ) );
    
    }
    
    /**
     * Currently the following case is not allowed:
     * - Changing the start date to a date where an occurrence already exists
     */
    public function testMoveOccurrenceNotAllowed()
    {
    	$event = array(
    		'start'         => new DateTime( '2014-08-11 18:48:00', eo_get_blog_timezone() ),
    		'end'           => new DateTime( '2014-08-11 19:48:00', eo_get_blog_timezone() ),
    		'schedule'      => 'weekly',
    		'until' => new DateTime( '2014-09-01 18:48:00', eo_get_blog_timezone() ),
    	);

    	$event_id       = $this->factory->event->create( $event );
    	$occurrences    = eo_get_the_occurrences_of( $event_id );
    	$occurrence_ids = array_keys( $occurrences );
    	$occurrence_id  = $occurrence_ids[2]; 
    	
    	//Check the start/end datetimes are as expected
    	$this->assertEquals( array(
    		'start' => new DateTime( '2014-08-25 18:48:00', eo_get_blog_timezone() ),
    		'end'   => new DateTime( '2014-08-25 19:48:00', eo_get_blog_timezone() ),
    	), $occurrences[$occurrence_id] );
    	
    	//Try to move to an 'occupied date' (even with different time)
    	$new_start = new DateTime( '2014-08-18 15:48:00', eo_get_blog_timezone() );
    	$new_end   = new DateTime( '2014-08-18 16:48:00', eo_get_blog_timezone() );
    	$response = eventorganiser_move_occurrence( $event_id, $occurrence_id, $new_start, $new_end );
    	
    	$this->assertInstanceOf( 'WP_Error', $response );
    	$this->assertEquals( 'events-cannot-share-date', $response->get_error_code() );
    
    }
    
}

