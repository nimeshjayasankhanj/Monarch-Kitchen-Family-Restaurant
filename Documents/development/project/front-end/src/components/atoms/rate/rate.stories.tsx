import type { Meta, StoryObj } from "@storybook/react";

import Rate from "./index";

const meta: Meta<typeof Rate> = {
  title: "rate",
  component: Rate,
};

export default meta;
type Story = StoryObj<typeof Rate>;

export const Index: Story = {
  args: {
    count: 1,
  },
};
