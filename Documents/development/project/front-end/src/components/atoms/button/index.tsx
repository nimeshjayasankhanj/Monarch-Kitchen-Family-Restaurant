import React from "react";
import { Button, Form, Space } from "antd";

interface ButtonProps {
  title: string;
  type?:
    | "primary"
    | "link"
    | "text"
    | "ghost"
    | "default"
    | "dashed"
    | undefined;
}

const Index = ({ title, type = "primary" }: ButtonProps) => {
  return (
    <Space direction="vertical" style={{ width: "100%" }}>
      <Button type={type} block={true} htmlType="submit">
        {title}
      </Button>
    </Space>
  );
};

export default Index;
