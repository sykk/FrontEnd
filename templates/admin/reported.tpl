{include file='header.tpl'}

<h1>Reported Image</h1>

<p>Reason: {$image.report.value}

<button id='approve'>Approve</button> <button id='reject'>Reject</button> <button id='skip'>Skip</button></p>
<a id='rand_link' href='reported?{$rand}' rel='nofollow'>
 <input type='hidden' name='uid' id='uid' value='{$image.image.uid}'>
 <input type='hidden' name='image_id' id='image_id' value='{$image.image.id}'>
 <img id='main_image' src='{$image_loc}' name='{$image.image.name}' height='{$image.image.height}' width='{$image.image.width}' alt='Main Image' />
</a>

{include file='footer.tpl'}