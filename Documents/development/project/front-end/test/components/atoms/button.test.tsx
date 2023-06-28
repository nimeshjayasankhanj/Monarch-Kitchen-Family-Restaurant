import "@testing-library/jest-dom";
import Button from "@/components/atoms/button";
import { render, screen } from "@testing-library/react";

describe("button component", () => {
  test("button title should be render correctly", () => {
    render(<Button title="Save" />);
    expect(screen.getByText(/Save/!)).toBeInTheDocument();
  });
});
