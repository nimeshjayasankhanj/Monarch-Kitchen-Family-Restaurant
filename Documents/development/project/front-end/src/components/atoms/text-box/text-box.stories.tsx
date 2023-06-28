import type { Meta, StoryObj } from "@storybook/react";

import TextBox from "./index";

const meta: Meta<typeof TextBox> = {
  title: "textbox",
  component: TextBox,
};

export default meta;
type Story = StoryObj<typeof TextBox>;

export const Index: Story = {
  args: {
    label: "text-box",
    name: "text-box",
    placeholder: "text-box",
  },
  argTypes: {
    size: {
      options: ["small", "large", "medium"],
      control: { type: "radio" },
    },
  },
};
