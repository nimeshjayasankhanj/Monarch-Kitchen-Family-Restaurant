import Head from "next/head";
import Image from "next/image";
import { Inter } from "@next/font/google";
import Card from "@/components/atoms/card";
import { Col, Row, Radio, Divider, Typography } from "antd";
import SelectBox from "@/components/atoms/select-box";
import { DatePicker, Space, Carousel } from "antd";
import Button from "@/components/atoms/button";
import CardWithImage from "@/components/atoms/cart-with-image";

const { RangePicker } = DatePicker;

const inter = Inter({ subsets: ["latin"] });
const { Title } = Typography;
const contentStyle: React.CSSProperties = {
  height: "350px",
  color: "#fff",
  lineHeight: "160px",
  textAlign: "center",
  background: "#364d79",
};
export default function Home() {
  return (
    <>
      <Row gutter={16}>
        <Col className="gutter-row" md={24} xs={24} sm={24}>
          <Card>
            <Radio.Group>
              <Radio
                value={1}
                style={{
                  backgroundColor: " #ffe8e8",
                  padding: "8px",
                  borderRadius: " 17px",
                }}
              >
                Apartments
              </Radio>
              <Radio
                value={1}
                style={{
                  backgroundColor: " #ffe8e8",
                  padding: "8px",
                  borderRadius: " 17px",
                  marginTop: "10px",
                }}
              >
                Hotels
              </Radio>
              <Radio
                value={1}
                style={{
                  backgroundColor: " #ffe8e8",
                  padding: "8px",
                  borderRadius: " 17px",
                  marginTop: "10px",
                }}
              >
                Flights
              </Radio>
              <Radio
                value={1}
                style={{
                  backgroundColor: " #ffe8e8",
                  padding: "8px",
                  borderRadius: " 17px",
                  marginTop: "10px",
                }}
              >
                Cab Services
              </Radio>
              <Radio
                value={1}
                style={{
                  backgroundColor: " #ffe8e8",
                  padding: "8px",
                  borderRadius: " 17px",
                  marginTop: "10px",
                }}
              >
                Hostels
              </Radio>
            </Radio.Group>
          </Card>
        </Col>
      </Row>
      <Row style={{ paddingTop: "20px" }}>
        <Col className="gutter-row" md={24} xs={24} sm={24}>
          <Card>
            <Row gutter={16}>
              <Col md={6} xs={24} sm={24}>
                <SelectBox />
              </Col>
              <Col md={14} xs={24} sm={24}>
                <RangePicker style={{ width: "100%" }} />
              </Col>
              <Col md={4} xs={24} sm={24}>
                <Button title="Search" />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
      <Divider>Offers</Divider>

      <Row style={{ paddingBottom: "20px" }}>
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>{" "}
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>{" "}
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>{" "}
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>{" "}
        <Col md={6} xs={24} sm={24} style={{ paddingBottom: "30px" }}>
          <CardWithImage />
        </Col>
      </Row>
    </>
  );
}
