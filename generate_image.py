from PIL import Image, ImageDraw, ImageFont
import os

# Create image canvas
width = 620
height = 220
bg_color = (250, 246, 240) # Warm light cream (#FAF6F0)

img = Image.new("RGB", (width, height), bg_color)
draw = ImageDraw.Draw(img)

# Outer border
draw.rectangle([0, 0, width - 1, height - 1], outline=(212, 199, 176), width=2)

# Colors
sage_green = (82, 115, 89)      # #527359
sage_dark = (61, 90, 68)        # #3D5A44
terracotta = (217, 119, 87)    # #D97757
terracotta_dark = (192, 92, 61) # #C05C3D
text_dark = (56, 51, 48)        # #383330
white = (255, 255, 255)

# Try loading standard font or default font
try:
    font_large = ImageFont.truetype("arial.ttf", 16)
    font_bold = ImageFont.truetype("arialbd.ttf", 15)
    font_small = ImageFont.truetype("arial.ttf", 12)
except Exception:
    font_large = font_bold = font_small = ImageFont.load_default()

# Header text inside image
draw.text((width // 2, 22), "INTERACTIVE CLIENT-SIDE IMAGE MAP", fill=text_dark, font=font_bold, anchor="ms")
draw.text((width // 2, 38), "Click on either shape to navigate to that page", fill=(120, 110, 100), font=font_small, anchor="ms")

# Draw Circle (Left)
# Center: (150, 115), Radius: 50 -> Bounding Box: [100, 65, 200, 165]
center_x, center_y, radius = 150, 115, 50
draw.ellipse(
    [center_x - radius, center_y - radius, center_x + radius, center_y + radius],
    fill=sage_green,
    outline=sage_dark,
    width=3
)
draw.text((center_x, center_y - 6), "CIRCULAR HOTSPOT", fill=white, font=font_bold, anchor="mm")
draw.text((center_x, center_y + 10), "(Links to Home)", fill=(235, 245, 235), font=font_small, anchor="mm")
draw.text((center_x, center_y + radius + 18), "coords: 150,115,50", fill=sage_dark, font=font_small, anchor="ms")

# Draw Rectangle (Right)
# Coords: [370, 65, 570, 165] -> x1=370, y1=65, x2=570, y2=165
rect_x1, rect_y1, rect_x2, rect_y2 = 370, 65, 570, 165
draw.rectangle(
    [rect_x1, rect_y1, rect_x2, rect_y2],
    fill=terracotta,
    outline=terracotta_dark,
    width=3
)
rect_center_x = (rect_x1 + rect_x2) // 2
rect_center_y = (rect_y1 + rect_y2) // 2
draw.text((rect_center_x, rect_center_y - 6), "RECTANGULAR HOTSPOT", fill=white, font=font_bold, anchor="mm")
draw.text((rect_center_x, rect_center_y + 10), "(Links to Contact)", fill=(255, 240, 235), font=font_small, anchor="mm")
draw.text((rect_center_x, rect_y2 + 18), "coords: 370,65,570,165", fill=terracotta_dark, font=font_small, anchor="ms")

# Save image
output_path = r"c:\Users\91932\Documents\PROGRAMMING\shreya\Assignment\imagemap.png"
img.save(output_path)
print("Image saved successfully to", output_path)
