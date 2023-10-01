<div class="row">
	<div class="col-8 offset-2">
		<div class="card">
			<div class="card-body">
				<form method="post" onsubmit="return false" id="companyEditInfo" autocomplete="off">
					<input type="hidden" name="company_id" value="<?= $company_id;?>">
					<div class="row mb-3">
						<label class="control-label col-md-3">Company Name <span class="text-danger">*</span></label>
						<div class="col-md-9">
							<input type="text" name="name" class="form-control input-name" placeholder="Company Name" value="<?= $company_info->properties->name->value;?>" />
							<div id="error"></div>
						</div>
					</div>
					<div class="row mb-3">
						<label class="control-label col-md-3">City <span class="text-danger">*</span></label>
						<div class="col-md-9">
							<input type="text" name="city" class="form-control input-city" placeholder="City" value="<?= $company_info->properties->city->value;?>" />
							<div id="error"></div>
						</div>
					</div>
					<div class="row mb-3">
						<label class="control-label col-md-3">Pais <span class="text-danger">*</span></label>
						<div class="col-md-9">
							<input type="text" name="pais" class="form-control input-pais" placeholder="Pais" value="<?= $company_info->properties->pais->value;?>" />
							<div id="error"></div>
						</div>
					</div>
					<div class="row mb-3">
						<label class="control-label col-md-3">Address <span class="text-danger">*</span></label>
						<div class="col-md-9">
							<input type="text" name="address" class="form-control input-address" placeholder="Address" value="<?= $company_info->properties->address->value;?>" />
							<div id="error"></div>
						</div>
					</div>
					<div class="row mb-3">
						<label class="control-label col-md-3">CIF <span class="text-danger">*</span></label>
						<div class="col-md-9">
							<input type="text" name="cif" class="form-control input-cif" placeholder="CIF" value="<?= $company_info->properties->cif->value;?>" />
							<div id="error"></div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-md-9 offset-3">
							<button class="btn btn-info btn-lg" id="btn_save">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click','#btn_save',function(){
		var button = $(this); 
	    var originalButtonText = button.html();
	    button.html('Please wait...');
		$.ajax({
            url: "<?= base_url('update-company');?>",
            method: "POST",
            data:$('#companyEditInfo').serialize(),
            dataType: "json",
            success: function(response) {
            	console.log(response);
            	button.html(originalButtonText);
            	if(response.status=='true'){  
                    toastr.success(response.message);
                }else if(response.status=='false'){
                    toastr.error(response.message);
                }else{
                    $.each(response, function(key, value) {
                        if(value !=''){
                            $('.input-' + key).addClass('is-invalid');
                        }
                        $('.input-' + key).parents('.mb-3').find('#error').html(value);
                    });
                }
            }
        });
	})

	$('#companyEditInfo input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.mb-3').find('#error').html(" ");
    });
</script>