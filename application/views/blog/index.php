<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Just a {code} blog">
    <meta name="author" content="Theodoros Deligiannidis">

    <title>Just a {code} blog</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo asset_url();?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
      <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->
    
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto|Source+Sans+Pro|Open+Sans|Slabo+27px" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo asset_url();?>/css/blog.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head>
 
<body>
<div class="container">
  <div class="blog-header">
    {about}
    <h1 class="blog-title"><a href="/">{blog_name}</a></h1>
    <p class="lead blog-description">{blog_subtitle}</p>
    {/about}
  </div>

    <div class="row">      
      <div class="col-sm-8 blog-main">

        {posts}
        <div class="blog-post">
          <h2 class="blog-post-title"> <?php if($show_pager==0) echo '<a href="/index.php/blog/{entry_id}">';?> {entry_name} </a></h2>
          <p class="blog-post-meta"> {entry_date} <!--Author: <a href="#"> {entry_author} </a>-->Tags: {entry_tags}</p>
           <div class="blog-body"><?php if($in_post==0){echo '{entry_body_summary}';} else { echo '{entry_body}';} ?>
           </div>
        </div>
        {/posts}
        
        <?php if($show_pager==0) {?>
        <nav>
          <ul class="pager">
            <?php $current_page++;if($current_page<=$total_pages)echo '<li><a href="/index.php/page/'.$current_page.'">Older Posts</a></li>' ;?>
            <?php if(isset($previous_page) && $previous_page>0)echo '<li><a href="/index.php/page/'.$previous_page.'">Newer Posts</a></li>' ;?>
          </ul>
        </nav>
        <?php }?>

      </div>
      <!-- /.blog-main -->
      <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
        <div class="sidebar-module sidebar-module-inset">
          {about}
            <h4>About {author_name}</h4>
            <p>{bio}</p>
          {/about}
        </div>
        <div class="sidebar-module">
          <h4>Latest posts</h4>
            <ol class="list-unstyled">
              {latest}
                <li><a class="link-blue" href="/index.php/blog/{entry_id}">{entry_name}</a></li>
              {/latest}
            </ol>
        </div><!--
        <div class="sidebar-module">
          <h4>Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>-->
      </div>
      <!-- /.blog-sidebar -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <footer class="blog-footer">
    <p>Made with <a href="https://www.codeigniter.com"> CodeIgniter </a>
    <p>Blog template by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
      <a href="#">Back to top</a>
    </p>
  </footer>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="<?php echo asset_url();?>/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>

</body>
</html>