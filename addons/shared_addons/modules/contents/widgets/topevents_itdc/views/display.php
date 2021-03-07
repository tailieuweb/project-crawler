<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Sự kiện <br/><span>Hoạt động</span></h2>
    </div>
    <div class="crossedbg"></div>
    <div class="panel-body bodytimeline">

        <ul class="timeline">
            <?php for ($index = 0; $index < count($events); $index++):?>
            <li>
                <!--Left-->
                <?php 
                    $eventtime = $this->my_utilities->parse_date($events[$index]['event_time']);
                    $eventnow = $this->my_utilities->parse_date(time());//TODO: check month
                ?>
                <div class="timeline-badge <?php echo strcmp($eventtime['day'], $eventnow['day']) == 0?'current':'' ?>"></div>
                <div class="timeline-panel">
                    <div class="eventtime">
                        <div class="eventtimecover">
                            <div class="eventdm">
                                <div class="eventday"><?php echo $eventtime['day'] ?></div>
                                <div class="eventmonth"><?php echo $eventtime['month'] ?></div>
                            </div>
                            <div class="eventyear">'<?php echo $eventtime['year'] ?></div>
                        </div>
                    </div>
                    <div class="eventdetails">
                        <div class="eventlocation">
                            <?php echo $events[$index]['event_location'] ?>
                        </div>
                        <div class="eventdesc">
                            <?php echo anchor($events[$index]['uri'], $events[$index]['title']); ?>
                        </div>
                    </div>
                </div>
            </li>
            <!--Right-->
            <?php if ($index + 1 < count($events)):?>
            <?php 
                $index++;
                $eventtime = $this->my_utilities->parse_date($events[$index]['event_time']);
                $eventnow = $this->my_utilities->parse_date(time());
            ?>
            <li class="timeline-inverted ">
                <div class="timeline-badge <?php echo strcmp($eventtime['day'], $eventnow['day']) == 0?'current':'' ?>"></div>
                <div class="timeline-panel">
                    <div class="eventtime">
                        <div class="eventtimecover">
                            <?php $eventtime = $this->my_utilities->parse_date($events[$index]['event_time']) ?>
                            <div class="eventdm">
                                <div class="eventday"><?php echo $eventtime['day'] ?></div>
                                <div class="eventmonth"><?php echo $eventtime['month'] ?></div>
                            </div>
                            <div class="eventyear">'<?php echo $eventtime['year'] ?></div>
                        </div>
                    </div>
                    <div class="eventdetails">
                        <div class="eventlocation">
                            <?php echo $events[$index]['event_location'] ?>
                        </div>
                        <div class="eventdesc">
                            <?php echo anchor($events[$index]['uri'], $events[$index]['title']); ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif;?>
            <?php endfor; ?>
        </ul>
    </div>
    <div class="crossedbg"></div>
</div>