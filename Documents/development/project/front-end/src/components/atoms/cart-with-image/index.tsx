import React from "react";
import { Card } from "antd";

const { Meta } = Card;

const CardWithImage: React.FC = () => (
  <Card
    hoverable
    style={{ width: 340 }}
    cover={
      <img
        alt="example"
        src="https://cf.bstatic.com/xdata/images/hotel/square600/13125860.webp?k=35b70a7e8a17a71896996cd55d84f742cd15724c3aebaed0d9b5ba19c53c430b&o="
      />
    }
  >
    <Meta title="Europe Street beat" description="www.instagram.com" />
  </Card>
);

export default CardWithImage;
