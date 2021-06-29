<h1>Magento 2 Custom Logout Redirect</h1>
<p>Compatible with magento 2.3.*</p>

<h2>Installation</h2>
<ol>
	<li>Create Elite/RedirectLogout inside your app/code folder to your magento installtion</li>
	<li><pre>git clone https://github.com/Emil1997/magento2-custom-logout-redirect.git</pre></li>
	<li><pre>php bin/magento module:enable Elite_RedirectLogout</pre></li>
	<li><pre>php bin/magento setup:upgrade</pre></li>
	<li><pre>php bin/magento setup:di:compile</pre></li>
</ol>

<h2>Configuration</h2>
<ol>
    <li>Navigate to: Stores -> Configuration <br> <img src="web/media/configuration.png"></li>
    <li>Redirect URL: Set the path you want to redirect after logout</li>
</ol>
