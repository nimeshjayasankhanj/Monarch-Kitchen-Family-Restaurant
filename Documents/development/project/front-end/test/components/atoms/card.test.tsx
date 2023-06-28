import "@testing-library/jest-dom";
import { render, screen } from "@testing-library/react";
import Card from "@/components/atoms/card";
import MockCardBody from "test/mock/mock-card-body";

describe("card component", () => {
  test("should be render card component", () => {
    render(
      <Card>
        <MockCardBody />
      </Card>
    );
    expect(screen.getByText(/Hello this is my card/!)).toBeInTheDocument();
  });
});
