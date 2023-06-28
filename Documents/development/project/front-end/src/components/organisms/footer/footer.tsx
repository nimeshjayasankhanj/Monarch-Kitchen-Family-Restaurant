import React from "react";
import { Col, Divider, Layout, Row, Typography } from "antd";
import Link from "next/link";
import Image from "next/image";

const { Footer } = Layout;
const { Title } = Typography;

const FooterBar: React.FC = () => {
  return (
    <>
      <Footer>
        <Row>
          <Col md={10} xs={24} sm={24}>
            <Link href="login">
              <Title level={5} style={{ textAlign: "left", color: "white" }}>
                Apartments
              </Title>
            </Link>
            <Link href="login">
              <Title level={5} style={{ textAlign: "left", color: "white" }}>
                Hotels
              </Title>
            </Link>
            <Link href="login">
              <Title level={5} style={{ textAlign: "left", color: "white" }}>
                Flights
              </Title>
            </Link>
            <Link href="login">
              <Title level={5} style={{ textAlign: "left", color: "white" }}>
                Cab Services
              </Title>
            </Link>{" "}
            <Link href="login">
              <Title level={5} style={{ textAlign: "left", color: "white" }}>
                Hostels
              </Title>
            </Link>
          </Col>
          <Col md={4}>
            <Title level={3} style={{ textAlign: "left", color: "white" }}>
              Helpful Resources
            </Title>
            <Title level={5} style={{ textAlign: "left", color: "white" }}>
              About Booking.com
            </Title>
            <Title level={5} style={{ textAlign: "left", color: "white" }}>
              Terms of Use
            </Title>
            <Title level={5} style={{ textAlign: "left", color: "white" }}>
              Privacy Center
            </Title>
            <Title level={5} style={{ textAlign: "left", color: "white" }}>
              Security Center
            </Title>
          </Col>
        </Row>
        <Row>
          <Col md={24}>
            <Divider style={{ backgroundColor: "white" }}></Divider>
            <Title level={5} style={{ textAlign: "center", color: "white" }}>
              © All right Reversed 2023. Booking.com
            </Title>
          </Col>
        </Row>
      </Footer>
    </>
  );
};

export default FooterBar;
