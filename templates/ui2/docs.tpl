{include file='head.tpl'}

<h1>API Docs for {$class.name}</h1>

<div id='classes'>
    <h2>Classes</h2>
    {foreach $classes as $classname}
     <p><a href='/docs/{$classname}'>{$classname}</a></p>
    {/foreach}
</div>


<div class='apidocs'>
{foreach from=$class.method item=method}
 <div class='method'>
 <h2 id='{$method.name}'>{$class.name}/{$method.name}</h2>
 {$method.docblock.{'long-description'}}
 <p class='endpoint'>Endpoint: <a href='{$web_root}api/{$class.name}/{$method.name}'>{$web_root}api/{$class.name}/{$method.name}</a></p>
 <!--<p>{$method.docblock.description}</p>-->
 
 {if isset($method.params)}
 <h3>Parameters</h3>
 {foreach $method.params as $param}
  <p><span class='type'>{$param.type}</span> <span class='variable'>{$param.variable}</span> <span class='desc'>{$param.description}</span></p>
 {/foreach}
 {/if}
 
 </div>
{/foreach}
</div>

{include file='foot.tpl'}