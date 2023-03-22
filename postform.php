<form className="bug-form" action="processpost">
	<h2><?php //create / edit 
			?></h2>
	<div className="form-fields">
		<label>Title (required):</label>
		<input id="title" type="text" required placeholder="blog title"></input>
		<label>Content (required):</label>
		<textarea id="content" required placeholder="blog text"></textarea>
		<label>Category (required):</label>
		<select id="category" required>
			<option>books</option>
			<option>games</option>
			<option>movies</option>
			<option>music</option>
			<option>nature</option>
			<option>poetry</option>
		</select>
		<label>Image (optional):</label>
		<input id="image" type="file"></input>
	</div>
	<div className="form-actions">
		<button type="submit" className="form-button">
			<?php //create / edit 
			?>
		</button>
	</div>
</form>