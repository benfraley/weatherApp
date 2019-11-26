$(document).ready(function(){
            
    $("#location").keyup(function(){

        if($(this).val().length === 0)
        {
            return;
        }

        $.ajax({
            url: "api/locations.php",
            data: 'search=' + $(this).val(),
            datatype: 'json',
            success: function(result){

                // making sure I haven't overloaded the api with requests, if so it doesn't work
                if( !("Code" in result && result.Code === "ServiceUnavailable") )
                {

                    var availableTags = [];
                    $.each(result, function( index, value ) {

                        tag = {};

                        label = value.LocalizedName;

                        if("LocalizedName" in value.AdministrativeArea)
                        {
                            label += " - " + value.AdministrativeArea.LocalizedName;
                        }

                        if("LocalizedName" in value.Country)
                        {
                            label += " - " + value.Country.LocalizedName;
                        }

                        tag.label = label;
                        tag.value = value.Key;

                        availableTags.push( tag );
                    });

                    /**
                     *  using jquery ui's autocomplete widget for the search box
                     *  this gives me control of what the user can type in and actually search for
                     */
                    $( "#location" ).autocomplete({
                        source: availableTags,
                        select: function (e, ui) {
                            e.preventDefault();
                            $( "#location" ).val(ui.item.label);
                            console.log(ui.item.value);

                             $.ajax({
                                url: "api/locations.php",
                                data: 'cityCode=' + ui.item.value,
                                datatype: 'json',
                                beforeSend: function(){
                                    $("#loading").show();
                                },
                                complete: function(result){
                                    // doing this just to show the loading icon
                                    setTimeout(function(){
                                        $("#loading").hide();
                                    }, 2000);
                                },
                                success: function(result){
                                    /**
                                     * Once we have our forecast data, put into some simple html strings for display
                                     * There's a million ways to make this look prettier but I find the beauty is generally 
                                     * in the eye of the beholder/client, so I'd get feedback from the client on how they 
                                     * want it to look
                                     */
                                    setTimeout(function(){
                                        $.each(result.DailyForecasts, function( index, value ) {
                                            if(index <= 2) // only showing 3 days of forecasts per instructions
                                            {
                                                thisDate = new Date(value.EpochDate * 1000);
                                                html = thisDate.toLocaleDateString("en-US") + "<br/>";
                                                html += "High: " + value.Temperature.Maximum.Value + value.Temperature.Maximum.Unit;
                                                html += " / Low: " + value.Temperature.Minimum.Value + value.Temperature.Minimum.Unit + "<br/>";
                                                html += "Day: " + value.Day.IconPhrase + "<br/>";
                                                html += "Night: " + value.Night.IconPhrase + "<br/>";
                                                html += "<a href='" + value.Link + "' target='_blank'>More Info</a>";
                                                $("#forecast"+index).html(html);
                                            }
                                        });
                                    }, 2000);
                                }
                            });

                        }
                    });

                }
                else 
                {
                    console.log(result);
                    alert ("The Weather API is currently unavailable. Please try again later.");
                }

            }
          });

    });
    
    $("#clear").click(function(){
        $( "#location" ).val("");
    });

});