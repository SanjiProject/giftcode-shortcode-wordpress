# Customizable Gift Code Shortcode 🎁🔑

**Customizable Gift Code Shortcode** is a simple yet powerful WordPress plugin that allows you to display a customizable gift code on your website. You can change the gift code, button colors, and more directly from the plugin's settings page. This plugin also allows users to copy the shortcode directly from the settings page.

![Gift Code Thumbnail](https://i.imgur.com/HKEQKkd.png)

## ✨ Features
- **Customizable Gift Code:** 🛠️ Easily change the gift code that will be displayed on the frontend.
- **Button Color Customization:** 🎨 Change the background and text color of the button using color pickers.
- **Copy Shortcode:** 📋 The plugin allows users to copy the shortcode `[gift_code]` directly from the settings page.
- **Frontend Display:** 🌍 The gift code and button are displayed on the frontend wherever the shortcode `[gift_code]` is used.

## 🚀 Getting Started

### Installation
1. Download the plugin or clone the repository.
2. Upload the plugin files to your WordPress site's `/wp-content/plugins/customizable-gift-code-shortcode` directory.
3. Activate the plugin through the **Plugins** screen in WordPress.

### Usage

1. Navigate to the **Gift Code Settings** page under the **Settings** menu in your WordPress dashboard.
2. Input the gift code that you want to display on the frontend.
3. Customize the button background and text color using the color pickers.
4. Save your settings and use the `[gift_code]` shortcode on any page or post where you want the gift code to appear.
5. You can also copy the shortcode directly from the settings page.

### Example Configuration

- Set the **Gift Code** to `ABC123XYZ`.
- Customize the **Button Background Color** and **Button Text Color**.
- Use the shortcode `[gift_code]` on your posts or pages to display the code and button.

## 🔧 Options and Customization

You can configure the following settings through the plugin’s dashboard:
- **Gift Code:** Set the gift code value to display.
- **Button Background Color:** Customize the button's background color.
- **Button Text Color:** Customize the button's text color.

## 🛠️ Developer Features

This plugin is developer-friendly, offering hooks and actions that you can extend or modify to your liking:
- `add_action('init', 'gift_code_shortcode');`
- `add_action('wp_head', 'gift_code_shortcode_styles_custom');`
- Easily extend the functionality by adding custom actions and filters.

## 🎨 Screenshots

1. **Settings Page:** Manage gift code, button background color, and text color.
   ![Settings Screenshot](assets/settings.png)

2. **Frontend Display:** See the gift code and customizable button on the page.
   ![Frontend Display Screenshot](assets/frontend-display.png)

## 👨‍💻 Contributing

We welcome contributions to improve the plugin! Feel free to open issues, submit pull requests, or suggest new features. Let’s work together to make the plugin even better!

## ⚖️ License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🚀 Changelog

### v1.1 (Current Version)
- Added the ability to copy the shortcode directly from the settings page.
- Added options for customizing button colors.
- Improved the user interface and settings page layout.

### v1.0
- Initial release with options to set the gift code and customize button colors.

---

Take control of your gift codes today with **Customizable Gift Code Shortcode**! 🎉🎁
