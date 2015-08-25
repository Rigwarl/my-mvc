
<div class="container">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo $this->title; ?></h1>
		<a href="<?php echo $this->user->get('backlink'); ?>" class="btn btn-primary pull-right">← back to comments</a>
	</div>
		
	  <?php if ($this->msg('saved')): ?>
	  	<p class='alert alert-success'>Comment successfully saved.</p>
	  <?php elseif ($this->is_error('save')): ?>
	  	<p class='alert alert-danger'>Sorry, something went wrong. Please try later...</p>
	  <?php endif; ?>

	  <form method="post" action="/admin/comments/edit/<?php echo $id; ?>">
	    <div class="form-group<?php echo $this->is_error('title') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="title">
	        <?php if ($this->is_error('title', 'required')): ?>
	          Title must not be blank
	        <?php else: ?>
	          Title
	        <?php endif; ?>
	      </label>
	      <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $title ?>">
	    </div>
	    <div class="form-group<?php echo $this->is_error('estimate') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="estimate">
	        <?php if ($this->is_error('estimate', 'required')): ?>
	          Estimate must not be blank
	        <?php elseif ($this->is_error('estimate')): ?>
	          Estimate must be an integer from 1 to 10
	      	<?php else: ?>
	          Estimate
	        <?php endif; ?>
	      </label>
	      <input type="text" name="estimate" class="form-control" id="estimate" placeholder="Integer from 1 to 10" value="<?php echo $estimate ?>">
	    </div>
	    <div class="form-group<?php echo $this->is_error('comment') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="comment">
	        <?php if ($this->is_error('comment', 'required')): ?>
	          Comment must not be blank
	        <?php else: ?>
	          Comment
	        <?php endif; ?>
	      </label>
	      <textarea name="comment" class="form-control" id="comment"><?php echo $comment; ?></textarea>
	    </div>
	    <button type="submit" class="btn btn-success">Save</button>
	  </form>
</div>