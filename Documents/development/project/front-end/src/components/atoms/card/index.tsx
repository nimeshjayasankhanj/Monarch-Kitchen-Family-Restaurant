import React from "react";
import { Card } from "antd";

interface cardProps {
  children: any;
  image?: string;
}

const CardComponent = ({ children, image = "" }: cardProps) => {
  return (
    <Card>
      <>{children}</>
    </Card>
  );
};

export default CardComponent;
