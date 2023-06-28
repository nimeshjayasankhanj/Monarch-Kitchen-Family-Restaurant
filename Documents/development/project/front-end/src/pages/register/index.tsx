import { Col, Form, Row, Typography } from "antd";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";

import CardComponent from "@/components/atoms/card";
import InputBox from "@/components/atoms/text-box";
import Button from "@/components/atoms/button";
import { schema } from "./schema";

const { Title } = Typography;

interface RegisterForm {
  full_name: string;
  phone_number: string;
  email_address: string;
  password: string;
}

const Register = () => {
  const {
    handleSubmit,
    control,
    formState: { errors },
  } = useForm({
    defaultValues: {
      full_name: "",
      phone_number: "",
      email_address: "",
      password: "",
    },
    resolver: yupResolver(schema),
  });
  const onSubmit = (data: RegisterForm) => {};
  return (
    <Row>
      <Col md={8}></Col>
      <Col md={8} sm={24} xs={24}>
        <CardComponent>
          <Title level={3} className="center-text">
            Get started with Booking.com
          </Title>
          <Form
            onFinish={handleSubmit(onSubmit)}
            layout="vertical"
            autoComplete="off"
          >
            <InputBox
              label="Full Name"
              name="full_name"
              control={control}
              errors={errors?.full_name?.message}
            />
            <InputBox
              label="Email Address"
              name="email_address"
              control={control}
              errors={errors?.email_address?.message}
            />
            <InputBox
              label="Phone Number"
              name="phone_number"
              control={control}
              errors={errors?.phone_number?.message}
            />
            <InputBox
              label="Password"
              name="password"
              control={control}
              type="password"
              errors={errors?.password?.message}
            />
            <Button title="Register" />
          </Form>
        </CardComponent>
      </Col>
    </Row>
  );
};

export default Register;
