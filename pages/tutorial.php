<div class="page-header">
  <div class="container">
    <div class="row">
    <div class="col-xs-12 col-md-8 col-lg-offset-2">
    <h1>Tutorial<br/>
      <small>Let's try it</small>
    </h1>
    </div>
    </div>
  </div>
</div>
<div class="container"> 
  <div class="row">
    <div class="col-xs-12 col-md-8 col-lg-offset-2">
        <div class="row">
          <div class="col-xs-12">
          <a href="<?php echo site_url('welcome');?>" class="text-right">back to home</a> 
          <p>Create controller and save it, in folder actions/Hello.php

          </p>
          <h3><strong>Let's say hello</strong></h3>
          <div class="well">
            <code>
              class Hello{
                function index(){
                    echo "hello world";
                }
              }
            </code>
          </div>
          <h3><strong>Hello with page</strong></h3>
          <div class="well">
          <code>
            class Hello{
              function index(){
                  $this->show_page('hello');
              }
            }
          </code>

        </div>
        <h3><strong>Hello via param</strong></h3>
        <div class="well">
          <code>
            class Hello{
              function index($word='world'){
                  echo "hello ".$word;
              }
            }
          </code>
        </div>
      <h3><strong>Hello send data to page</strong></h3>
        <div class="well">
          <strong>actions/Hello.php</strong></br>
          <code>
            class Hello{
              function index($word='world'){
                  $this->page->data['word'] ='world';
                  $this->show_page('hello');
              }
            }
          </code><br/>
          <strong>pages/hello.php</strong></br>
          <code>
            <p> Hello <strong>$word</strong></p>
          </code><br/>
        </div>
        </div>
      </div>
    </div>
  </div>

</div>
