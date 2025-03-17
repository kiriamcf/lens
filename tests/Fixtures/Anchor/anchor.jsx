import React from "react";

const AnchorComponent = ({ url = "https://example.com", target = "_blank" }) => {
  return (
    <div>
      {/* ✅ Good: Has both href and target */}
      <a href={url} target={target}>Valid Anchor</a>

      {/* ❌ Bad: Missing href */}
      <a target={target}>Missing Href</a>

      {/* ⚠️ Bad: Missing target */}
      <a href={url}>Missing Target</a>

      {/* ❌ Bad: No attributes */}
      <a>No Attributes</a>
    </div>
  );
};

export default AnchorComponent;