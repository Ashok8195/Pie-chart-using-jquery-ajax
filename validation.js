$("#validateForm").validate({
  rules: {
    empid: {
      required: true,
    },
    empname: {
      required: true,
    },
    empadd: {
      required: true,
    },
    departments: {
      required: true,
    },
    empsal: {
      required: true,
    },
    email: {
      required: true,
      email: true,
    },
    address: {
      required: true,
      minlength: 5,
    },
    mobile: {
      required: true,
      minlength: 10,
      maxlength: 10,
    },
  },
  messages: {
    empid: {
      required: "Please enter Your empid",
    },
    empname: {
      required: "Please enter Your Name",
    },
    empadd: {
      required: "Please enter Your Address",
    },
    departments: {
      required: "select your department",
    },
    empsal: {
      required: "enter your Salary",
    },
    email: {
      required: "Please enter a valid email address",
    },
    mobile: {
      required: " enter valid number",
      minlength: "min length 10 char",
      maxlength: "max length 10 char",
    },
  },
  submitHandler: function (form) {
    form.submit();
  },
});
