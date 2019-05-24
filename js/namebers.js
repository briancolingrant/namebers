$( function() {
    // Get the form.
    var form = $( '#namebers' );
    // Get the messages div.
    var formMessages = $( '#form-messages' );
    var formResults = $( '#form-results' );

    // Set up an event listener for the contact form.
    $( form ).submit( function( e ) {
        // Stop the browser from submitting the form.
        e.preventDefault();
        // Serialize the form data.
        var formData = $( form ).serialize();
        // Submit the form using AJAX.
        $.ajax( {
            type: 'POST',
            url: $( form ).attr( 'action' ),
            data: formData
        } ).done( function( response ) {
            console.log( "Done." );
            // Make sure that the formMessages div has the 'success' class.
            $( formMessages ).removeClass( 'error' );
            $( formMessages ).addClass( 'success' );
            // Set the message text.
            populateDataFromJSON(response);
            // Clear the form.
            $( '#name' ).val( '' );
        } ).fail( function( data ) {
            console.log( "Fail." );
            // Make sure that the formMessages div has the 'error' class.
            $( formMessages ).removeClass( 'success' );
            $( formMessages ).addClass( 'error' );
            // Set the message text.
            if ( data.responseText !== '' ) {
                $( formMessages ).text( data.responseText );
            } else {
                $( formMessages ).text( 'Oops! The response text was empty.' );
            }
        } );
    } );

  function populateDataFromJSON(jsonData) {
    var nameber = JSON.parse(jsonData);

    function App() {
      var deck = React.createElement("div", {className: "card-deck"},
        React.createElement(BootstrapCard, {title: "Hexadecimal", body: nameber.numbers.arabic.base["16"].string}),
        React.createElement(BootstrapCard, {title: "Decimal", body: nameber.numbers.arabic.base["10"].string}),
        React.createElement(BootstrapCard, {title: "Octal", body: nameber.numbers.arabic.base["8"].string}),
        React.createElement(BootstrapCard, {title: "Binary", body: nameber.numbers.arabic.base["2"].string}),
        React.createElement(BootstrapCard, {title: "Vigesimal", body: nameber.numbers.arabic.base["20"].string}),
        React.createElement(BootstrapCard, {title: "Roman", body: nameber.numbers.roman.string})
      );
      return ( React.createElement("div", null, deck) );
    }

    ReactDOM.render(
      React.createElement(App, null),
      document.getElementById('form-results')
    );
  }

} );
