<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <script src='<?php echo base_url(); ?>assets/jquery.min.js'></script>
  <script src='<?php echo base_url(); ?>assets/burn_bundle.js'></script>

  <!-- Instantiate burn widget -->
  <script type='text/javascript'>
    <?php header("Access-Control-Allow-Origin: *"); ?>
    var burnWidget = new BONZ.BurnWidget({
      apiKey: '<?php echo API_KEY; ?>',
      userId: '<?php echo USERID; ?>', // A unique id that identifies this user within *your* application
      //callback: 'http://laced.sensussoft.com/Items/',
      onIndex: function(jsonResponse) {
        // Callback to be triggered when requesting all burns for this user
        console.log(jsonResponse);
      },
      onShow: function(imageSelector, jsonResponse) {
        // Callback to be triggered after the show/edit burn is popped up
        console.log(imageSelector);
        console.log(jsonResponse);
      },
      onCreate: function(imageSelector, jsonResponse) {
        // Callback to be triggered after a burn is queued/created.
        // We recommend adding your own functionality to save the id and user_id the returned in jsonResponse
        console.log(imageSelector);
        console.log(jsonResponse);
      },
      onSave: function(imageSelector, jsonResponse) {
        // Callback to be triggered after the user selects a final mask
        // We recommend adding your own functionality to save the final_result_url the returned in jsonResponse
        console.log(jsonResponse);
        $(imageSelector).attr('src', jsonResponse.final_result_url);
      },
      onError: function(message) {
        // Callback to be triggered if the API action raises an exception
        alert(message);
        console.log(message);
      }
    });
    
    function burn(form) {
      burnWidget.launch({ url: $('input[type=text]', $(form)).val() });
      $('input[type=text]', $(form)).val('');
    }

    function burnImage() {
      // Queues a new burn from the src of the image element
      burnWidget.launch({ image: $('#image1') });
    }
    
    function burnURL(el) {
      // Queues a new burn from a URL
      burnWidget.launch({ url: $(el).attr('href') });
    }
    
    function showBurnByID(id) {
      // Shows the progress of the background burn with the specified id.
      burnWidget.launch({ id: id });
    }
    
    function showBurnByImage() {
      // Gets the id of the background burn from the data-id attribute,
      // and shows the progress of the burn.
      burnWidget.launch({ image: $('#image2') });
    }

    function viewBurns() {
      // Gets all in progress/complete burns for the user identified
      // by the userId parameter when instantiating a new BONZ.BurnWidget.
      burnWidget.launch();
    }
  </script>
</head>
<body>
  <h2>Burn any image accessible via a web browser</h2>
  <p>Enter a URL to an image in the box below.</p>
  <form action='#' method='post' onsubmit='burn(this); return false;'>
    <input type='text' name='remoteUrl' style='width: 400px;' />
    <input type='submit' />
  </form>
  
  <h2>Queue a burn using the <tt>src</tt> attribute of an <tt>img</tt> element.</h2>
  <img id='image1' src='https://bonanzaimagestest.s3.amazonaws.com/uploads/burnees/1432752586-1964-6184.jpg' style='width: 25%' />
  <p><a href='#' onclick='burnImage(); return false;'>Burn image</a></p>
  
  <h2>Queue a burn from a remote URL</h2>
  <p><a href='https://bonanzaimagestest.s3.amazonaws.com/uploads/burnees/1432752586-1964-6184.jpg' onclick='burnURL(this); return false;'>Burn URL</a></p>
  
  <h2>View the progress/edit a previously queued image</h2>
  <p>This example shows the progress of the Background Burn with the ID of 10297598</p>
  <p><a href='#' onclick='showBurnByID(10297598); return false;'>Show burn by ID</a></p>
  
  <p>This example shows the progress of the Background Burn with the ID of 6653207</p>
  <img id='image2' src='http://www.bonanza.com/background_masks/15807159.png?1397051807&composite=1' data-id='6653207' />
  <p><a href='#' onclick='showBurnByImage(); return false;'>Show burn by image</a></p>
  
  <h2>View all burns for a specific user</h2>
  <p><a href='#' onclick='viewBurns(); return false;'>View all burns</a>.</p>
</body>
</html>
