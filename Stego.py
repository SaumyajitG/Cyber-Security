import argparse
from PIL import Image, ImageFont, ImageDraw
import textwrap

def decode_image(filename="encoded_image.png"):
    encoded_image = Image.open(filename)
    red_channel = encoded_image.split()[0]

    x_size = encoded_image.size[0]
    y_size = encoded_image.size[1]

    decoded_image = Image.new("RGB", encoded_image.size)
    pixels = decoded_image.load()

    for i in range(x_size):
        for j in range(y_size):
            if bin(red_channel.getpixel((i, j)))[-1] == '0':
                pixels[i, j] = (255, 255, 255)
            else:
                pixels[i, j] = (0,0,0)
    decoded_image.save("decoded_image.png")

def write_text(text_to_write, image_size):
    image_text = Image.new("RGB", image_size)
    font = ImageFont.load_default().font
    drawer = ImageDraw.Draw(image_text)

    margin = offset = 10
    for line in textwrap.wrap(text_to_write, width=60):
        drawer.text((margin,offset), line, font=font)
        offset += 10
    return image_text

def encode_image(text_to_encode, template_image="sample.png"):
    template_image = Image.open(template_image)
    red_template = template_image.split()[0]
    green_template = template_image.split()[1]
    blue_template = template_image.split()[2]

    x_size = template_image.size[0]
    y_size = template_image.size[1]

    image_text = write_text(text_to_encode, template_image.size)
    bw_encode = image_text.convert('1')

    encoded_image = Image.new("RGB", (x_size, y_size))
    pixels = encoded_image.load()
    for i in range(x_size):
        for j in range(y_size):
            red_template_pix = bin(red_template.getpixel((i,j)))
            old_pix = red_template.getpixel((i,j))
            tencode_pix = bin(bw_encode.getpixel((i,j)))

            if tencode_pix[-1] == '1':
                red_template_pix = red_template_pix[:-1] + '1'
            else:
                red_template_pix = red_template_pix[:-1] + '0'
            pixels[i, j] = (int(red_template_pix, 2), green_template.getpixel((i,j)), blue_template.getpixel((i,j)))

    encoded_image.save("encoded_image.png")


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("-e", "--encode", nargs="*",
                        help="Encode an image. Provide file name after argument. Default : sample.png")
    parser.add_argument("-d", "--decode", nargs="*",
                        help="Decode an image. Provide file name after argument. Default: encoded_image.png")
    args = parser.parse_args()
    if args.encode == None and args.decode == None:
        exit(0)

    if args.encode != None:
        if len(args.encode) == 0:
            encode_image(raw_input("Enter text to encode - "))
        elif args.encode[0]:
            encode_image(raw_input("Enter text to encode - "), args.encode[0])
    if args.decode != None:
        if len(args.decode) == 0:
            decode_image()
        elif args.decode[0]:
            decode_image(args.decode[0])

if __name__ == '__main__':
    main()