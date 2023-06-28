import React from "react";
import { useSession, signIn, signOut } from "next-auth/react";
import { Row, Col, Typography, Divider, Form } from "antd";
import CardComponent from "@/components/atoms/card";
import InputBox from "@/components/atoms/text-box";
import Button from "@/components/atoms/button";
import { GoogleOutlined } from "@ant-design/icons";
import Image from "next/image";
import Link from "next/link";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";

const { Title } = Typography;

interface LoginForm {
  email_address: string;
  password: string;
}

const Login = () => {
  const schema = yup
    .object({
      email_address: yup
        .string()
        .required("Email is a required field")
        .email("Email should be valid email"),
      password: yup.string().required("Password is a required field"),
    })
    .required();

  const { control, handleSubmit } = useForm({
    defaultValues: {
      email_address: "",
      password: "",
    },
    resolver: yupResolver(schema),
  });

  const onSubmit = (data: LoginForm) => {};

  return (
    <Row>
      <Col md={8}></Col>
      <Col md={8} sm={24} xs={24}>
        <CardComponent>
          <Title level={3} className="center-text">
            Welcome Back!
          </Title>
          <Form onFinish={handleSubmit(onSubmit)} layout="vertical">
            <InputBox
              label="Email Address"
              name="email_address"
              control={control}
            />
            <InputBox label="Password" name="password" control={control} />
            <Button title="Login" />
          </Form>
          <Divider plain>OR</Divider>
          <Row
            style={{
              paddingTop: "20px",
            }}
          >
            <Col md={8} sm={8} xs={8}>
              <Image
                src="/google.png"
                alt="google"
                width={50}
                height={50}
                onClick={() => signIn("google")}
                style={{
                  display: "block",
                  marginLeft: "auto",
                  marginRight: "auto",
                  cursor: "pointer",
                }}
              />
            </Col>
            <Col md={8} sm={8} xs={8}>
              <Image
                src="/github.png"
                alt="google"
                onClick={() => signIn("github")}
                width={50}
                height={50}
                style={{
                  display: "block",
                  marginLeft: "auto",
                  marginRight: "auto",
                  cursor: "pointer",
                }}
              />
            </Col>
            <Col md={8} sm={8} xs={8}>
              <Image
                src="/facebook.png"
                alt="google"
                width={50}
                height={50}
                onClick={() => signIn("facebook")}
                style={{
                  display: "block",
                  marginLeft: "auto",
                  marginRight: "auto",
                  cursor: "pointer",
                }}
              />
            </Col>
          </Row>
          <Divider plain>
            Don’t have an account? <Link href="register">Register</Link>
          </Divider>
        </CardComponent>
      </Col>
      <Col md={8}></Col>
    </Row>
  );
};

export default Login;
