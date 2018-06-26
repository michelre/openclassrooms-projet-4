import $ from 'jquery';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import 'bootstrap-datepicker';

const initDatePicker = () => {

  $('#billet_visit_date').datepicker({
    startDate: new Date(),
    format: 'dd-mm-yyyy',
    daysOfWeekDisabled: [2],
    language: 'fr-FR',
  });

  $('#visitor_bithdate').datepicker({endDate: new Date(), format: 'dd-mm-yyyy', language: 'fr-FR'});
};

const emptyFields = (formFields) => {
  $(formFields).find('input').each(function () {
    $(this).val('')
  });
  $(formFields).find('select').each(function () {
    const firstOption = $($(this).find('option')[0]);
    $(this).val(firstOption.attr('value'))
  });
};

const getLastField = () => $('.fields')[$('.fields').length - 1];

const getNbFields = () => $('.fields').length;

const setVisitorTitles = () => {
  $('.title-visitor').each(function (idx) {
    $(this).text(`Visiteur ${idx + 1}`);
  });
};

const duplicateFields = () => {
  const newFields = $(getLastField()).clone();
  const nbFields = getNbFields();
  newFields.find('input').each(function(){
    let currentId = $(this).attr('id');
    currentId = currentId ? currentId.split('-')[0] : currentId
    $(this).attr('id', `${currentId}-${nbFields + 1}`);
  });
  return newFields;
};

const setTarifPrice = (age) => {
  if (age >= 0 && age < 4) {
    $('#billet_type').val('gratuit');
    $('#tarif_price').val(0);
  }
  if (age >= 5 && age < 12) {
    $('#billet_type').val('enfant');
    $('#tarif_price').val(8);
  }
  if (age >= 12 && age < 60) {
    $('#billet_type').val('normal');
    $('#tarif_price').val(16);
  }
  if (age >= 60) {
    $('#billet_type').val('senior');
    $('#tarif_price').val(12);
  }
};

const getAge = () => {
  const [day, month, year] = $('#visitor_bithdate').val().split('-');
  const birthdate = new Date(year, month - 1, day);
  return Math.round(Math.abs(new Date() - birthdate) / (1000 * 3600 * 24 * 365));
};

$(document).ready(function () {

  initDatePicker();
  $('#btnDel').attr('disabled', 'disabled');
  setVisitorTitles();

  $('#btnAdd').click(function () {
    const newElem = duplicateFields();
    emptyFields(newElem);
    $(getLastField()).append(newElem);
    if (getNbFields() > 1) {
      $('#btnDel').attr('disabled', null);
    }
    setVisitorTitles();
  });

  $('#btnDel').click(function () {
    $(getLastField()).remove();
    if (getNbFields() === 1) {
      $('#btnDel').attr('disabled', 'disabled');
    }
    setVisitorTitles();
  });

  $('#visitor_bithdate').on('change', () => setTarifPrice(getAge()));
});
