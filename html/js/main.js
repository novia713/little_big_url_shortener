
$( document ).ready(function() {
  var slug = null;
  $("#btn_submit").click(function() {
    //validate
    if ( !validate() ) {
      alert("Please, check your URL starts with http:// or https://");
      return;
    }

    $.post( "../create/" + $("#url").val(), function( data ) {
      //@TODO: verify data.slug != undefined
      slug = data.slug;
      console.info(data);
      $( "#result" ).html(
        "Your shorten'd URL is <h3><a href='http://"
        + document.domain + "/" + data.slug
        + "'>http://" + document.domain + "/" + data.slug
        + "</a></h3> &nbsp; <a id='btn_stats' href='#'>Stats of this link</a>"
      );
    });
  });

  function validate(){
    var url = $("#url").val();
    if ("" == url) return false;
    else {
      if ( url.indexOf("http://") == 0
        || url.indexOf("https://") == 0)
          return true;
      }
    return false;
  }

  function stats(e) {

    //@TODO: show "no stats yet" message if no data yet

    $.get( "../view/" + slug, function( data ) {
      console.info(data);
      if ("ok" == data.status) {
        var stats_content = " <p><a href='http://" +
            document.domain + "/" + slug +
            "'>http://" + document.domain + "/" + slug +
            "</a></p>\ <p>Total visits: " + data.total_visits + "</p> \
            Most visited day: " + data.day_most_visited + " </p>\
            <p>Today visits:" + data.visits_today + "</p>";
        $( "#result" ).fadeOut().empty().html(stats_content).fadeIn();
      }
    });
  }

  $(document).on('click', '#btn_stats', stats);
});
