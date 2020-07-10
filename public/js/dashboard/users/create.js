function typeChange (type) {
	if (type.value == 1)
		document.getElementById('specialty').closest('.form-group').classList.remove('d-none');
	else
		document.getElementById('specialty').closest('.form-group').classList.add('d-none');
}