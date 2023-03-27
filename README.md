# PhpAesUtil
PHP decrypt the data which encrypted  by JAVA AES 128 SHA1PRNG

由于要解密一个API传过来的数据，它是用的java的AES编码，但是Key又进行了SHA1PRNG的128编码，使用PHP解码时候，碰到一些问题。自己写代码解决。 

# Java encode and decode
    /**
    * AES 对称算法加密/解密工具类
    * @author Arthur.Xie
    */
        public static byte[] encrypt(byte[] plainBytes, byte[] key) throws Exception {
            // 生成密钥对象
            SecretKey secKey = generateKey(key);
            // 获取 AES 密码器
            Cipher cipher = Cipher.getInstance(ALGORITHM);
            // 初始化密码器（加密模型）
            cipher.init(Cipher.ENCRYPT_MODE, secKey);
            // 加密数据, 返回密文
            return cipher.doFinal(plainBytes);
        }

        /**
         * 数据解密: 密文 -> 明文
         * @param cipherBytes               密文字节数组
         * @param key                       密钥字节数组
         * @return                          明文字节数组
         * @throws Exception                抛出异常
         */
        public static byte[] decrypt(byte[] cipherBytes, byte[] key) throws Exception {
            // 生成密钥对象
            SecretKey secKey = generateKey(key);
            // 获取 AES 密码器
            Cipher cipher = Cipher.getInstance(ALGORITHM);
            // 初始化密码器（解密模型）
            cipher.init(Cipher.DECRYPT_MODE, secKey);
            // 解密数据, 返回明文
            return cipher.doFinal(cipherBytes);
        }

    }
    
    
# PHP code 
