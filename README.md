Google Maps Geocoder PHP Wrapper
=========================

<h3>So you dont have to think about it!</h3>
A straightforward, reliable, PHP wrapper for consuming the Google Geocoding API.

How to Use
--------
<ol>
    <li><strong>Construct a Geocoder with your google api_key</strong>
        <br/>
        <code>
            $geocoder = new Geocoder( "your_api_key" );
        </code>
    </li>
    <li><strong>Run a search or get the first match</strong>
        <br/>
        <code>
            $search = "Innovation Depot Birmingham";
            <br>
            $result = $geocoder->firstResult( $search );
        </code>
    </li>
    <li><strong>Interact with the data through the <em>ResultAdapter object</em></strong>
        <br/>
        <code>
            $result->getCoordinate();
            <br/>
            $result->getFormattedAddress();
        </code>
    </li>
</ol>

<h3> Not enough functionality? </h3>
<h6> We've only included what was applicable to another project, but all of our
packages are designed for easy scaling.</h6>

<h6> Feel free to add functionality for your project, just make sure to
send a pull request when you're done! </h6>
