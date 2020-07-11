var doctors = [];

(function () {
	doctors = [];
	let children = document.getElementById('doctor').children;

	for (let i = 0; i < children.length; i++) {
		doctors.push({
			id: children[i].value,
			name: children[i].innerHTML,
			specialty: children[i].dataset.specialty
		});
	}

	document.getElementById('pain').onchange();
})();

function painChange (pain) {
	let selectedSpecialty = pain.options[pain.selectedIndex].dataset.specialty;
	let doctorsElement = document.getElementById('doctor');
	doctorsElement.innerHTML = '';

	for (let i = 0; i < doctors.length; i++) {
		if (doctors[i].specialty == selectedSpecialty)
			doctorsElement.innerHTML += `<option value="${doctors[i].id}" data-specialty="${doctors[i].specialty}">${doctors[i].name}</option>`;
	}
}