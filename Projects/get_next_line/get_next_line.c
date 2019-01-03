/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/12/05 19:02:50 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/03 15:26:24 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

char	*ft_MallocNcat(char *s1, char *s2)
{
	char	*str;
	int		i;
	int		j;

	i = 0;
	j = 0;
	str = NULL;
	if (str)
		free(str);
	if (!(s1))
	{
		str = ft_strdup(s2);
		return (str);
	}
	str = (char *)malloc(sizeof(char) * (ft_strlen(s1) + ft_strlen(s2)) + 1);
	while (s1[i])
	{
		str[i] = s1[i];
		i++;
	}
	while (s2[j])
	{
		str[i] = s2[j];
		i++;
		j++;
	}
	str[ft_strlen(s1) + ft_strlen(s2)] = '\0';
	return (str);
}

int		ft_strsearch(char *str, char c)
{
	int		i;

	i = 0;
	if (str)
	{
		while (str[i])
		{
			if (str[i] == c)
				return (1);
			i++;
		}
	}
	return (0);
}

int		CutStr(char *buff, char **str, char **stock)
{
	int		i;

	i = 0;
	//printf("first stock = %s\n\n", *stock);
	if (ft_strsearch(*stock, '\n'))
   	{
	 	*str = ft_strsub(*stock, 0, ft_strchr(*stock, '\n') - *stock);
		if (buff)
	  	{
			*stock = ft_strjoin(ft_strchr(*stock, '\n') + 1, buff);
			return 0;
		}
		*stock = ft_strdup(ft_strchr(*stock, '\n') + 1);
	   	return 0;
	}
	if (ft_strsearch(buff, '\n'))
	{
		if (*stock)
		{
			*str = ft_strjoin(*stock, ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff));
			*stock = ft_strdup(ft_strchr(buff, '\n') + 1);
		   	return 0;
		}
		*str = ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff);
		*stock = ft_MallocNcat(*stock, (ft_strchr(buff, '\n') + 1));
		return (0);
	}
   	*stock = ft_MallocNcat(*stock, buff);
	//printf("stock after = %s\n\n", *stock);
   	return 1;
}

int		get_next_line(const int fd, char **line)
{
	static char		*stock;
	char			buff[BUFF_SIZE + 1];
	char			*str;
	int				ret;
	int				i;

	printf("Intial stock : %s\n",stock);
	if (fd < 0 || read(fd, buff, 0) == -1)
		return (-1);
	while ((ret = read(fd, buff, BUFF_SIZE)) > 0)
   	{
		//printf("buf = %s\n", buff);
		i = CutStr(buff, &str, &stock);
		if (i == 0)
		{
   			*line = str;
   			return 1;
		}
		ft_bzero(buff, BUFF_SIZE + 1);
   	}
	if (*stock != '\0')
   	{
		printf("''%s''\n", stock);
   	   	if (ft_strsearch(stock, '\n'))
   		{
			//printf("It's fucked up\n");
	   		str = ft_strsub(stock, 0, ft_strchr(stock, '\n') - stock);
	   		stock = ft_strdup(ft_strchr(stock, '\n') + 1);
	   		*line = str;
	   	}
		else
		{
			//printf("Current stock : %s\n", stock);
			*line = ft_strdup(stock);
			free(stock);
			*stock = '\0';
			//printf("New stock : %s\n", stock);
		}
	printf("stock after = %s\n\n", stock);
	if (*line)
		return (1);
	}
	free(stock);
	ft_bzero(stock, ft_strlen(stock));
	return (0);
}
