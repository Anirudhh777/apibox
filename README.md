<h3> SETUP </h3>
<ul>
	<li>Execute <code>start.sh</code> bash file to setup application</li>
	<li>Serving on port 8080</li>
	<li> <code>/regiser</code> for account creation. Login with email & password to retrieve API Token</li>
	<li>Run <code>docker-compose stop && docker-compose rm</code> to stop container</li>
</ul>

<p>Authentication : <code>api_token (Query Params) </code> </p>

<h3>ENDPOINTS</h3>

<ol>
	<li> <code> /api/add/ingredient </code> <span> | </span> <code> params: { name(string), supplier(string), measure('g', 'kg', 'pieces') } </code> </li>
	<li> <code> /api/fetch/ingredients </code> </li>
	<li> <code> /api/add/recipe </code> <span> | </span> <code> params: { name(string), description(string), ingredients(array(array('id', 'quantity'))) } </code> </li>
	<li> <code> /api/fetch/recipes </code> </li>
	<li> <code> /api/add/box </code> <span> | </span> <code> params: { delivery_date(date(Y-m-d)), recipes(array('recipe.id, recipe.id')) } </code> </li>
	<li> <code> /api/order/requirement </code> </li>
</ol>

