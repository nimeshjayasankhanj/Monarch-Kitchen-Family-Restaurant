import * as yup from "yup";
const passwordRules = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}$/;

export const schema = yup
  .object({
    full_name: yup.string().required("Name is a required field"),
    phone_number: yup.string().required("Phone Number is a required field"),
    email_address: yup
      .string()
      .required("Email is a required field")
      .email("Email should be valid email"),
    password: yup
      .string()
      .required("Password is a required field")
      .min(4, "Password at least contain four characters")
      .matches(passwordRules, {
        message: "Password is too weak",
      }),
  })
  .required();
