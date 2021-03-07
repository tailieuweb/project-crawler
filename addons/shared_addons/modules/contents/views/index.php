<?php 
    $this->load->view('partials/overview-post.php', array('post' => $data['news']));
    $this->load->view('partials/overview-work.php', array('works' => $data['works']));
    $this->load->view('partials/overview-post.php', array('post' => $data['skills']));