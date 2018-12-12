/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strcapitalize.c                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/09 22:49:49 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/13 20:27:19 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

char	*ft_strcapitalize(char *str)
{
	int i;
	int bool;

	bool = 1;
	i = 0;
	while (str[i] != '\0')
	{
		if (str[0] >= 'a' && str[0] <= 'z')
			str[0] = str[0] - 32;
		if (str[i] >= 'a' && str[i] <= 'z' && bool == 0)
			str[i] = str[i] - 32;
		if (str[i] >= 'A' && str[i] <= 'Z' && bool == 1)
			str[i] = str[i] + 32;
		if ((str[i] >= 'a' && str[i] <= 'z') || (str[i] >= 'A' && str[i] <= 'Z')
			|| (str[i] >= '0' && str[i] <= '9'))
			bool = 1;
		else
			bool = 0;
		i++;
	}
	return (str);
}
