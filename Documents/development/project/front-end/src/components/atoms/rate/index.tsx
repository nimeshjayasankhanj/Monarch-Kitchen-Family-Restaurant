import React from "react";
import { Rate } from "antd";

interface ratingProps {
  defaultValue: number;
  count: number;
  onChange: Function;
}

const Index = ({ defaultValue = 0, count, onChange }: ratingProps) => {
  return (
    <Rate
      allowClear
      defaultValue={defaultValue}
      count={count}
      onChange={(e) => onChange(e)}
    />
  );
};

export default Index;
